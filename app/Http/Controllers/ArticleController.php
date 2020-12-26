<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use App\Sidebar;
use App\Topic;
use App\Subtopic;
use App\User;
use App\Readlist;
use Storage;
use Illuminate\Http\Request;
use Session;
use File;

class ArticleController extends Controller
{
    public function __construct() {

        // $this->middleware('auth')->except('read','topic_filter');
        $this->middleware('auth')->only('index', 'create', 'store', 'show', 'update', 'destroy');
        // $this->middleware('admin')->only('index');
        $this->middleware('superadmin')->only('destroy');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $status = $request->input('status');
        if($status) {
            $articles = Article::orderBy('created_at', 'desc')->where('editor_status',$status)->paginate(10);
        
        } else {
            $articles = Article::orderBy('created_at', 'desc')->paginate(10);

        }

        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();

        return view('articles.index')->withArticles($articles)->withActivetopics($activetopics)->withActivesidebars($activesidebars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id = Auth::id();
        $user = User::find($id);

        if($user->author != "") {
            $topics = Topic::orderBy('id', 'asc')->where('status','active')->get();
            $subtopics = Topic::orderBy('id', 'asc')->where('status','active')->get();
            $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
            $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();

            return view('articles.create')->withActivesidebars($activesidebars)->withTopics($topics)
            ->withSubtopics($subtopics)->withActivetopics($activetopics);
        } else {
            Session::flash('error', 'Unauthorized Action');
            return redirect()->route('home');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $this->validate($request, array(
            'title' => 'required|max:255',
            'description' => 'max:255',
            'topic' => 'required|integer',
            'subtopic' => 'required|integer',
            'body' => 'required',
            'image' => 'required|image',
            'image_credit' => 'sometimes|max:50',
        ));
        $user_id = Auth::id();
        $topic_id = $request->topic;
        $subtopic_id = $request->subtopic;

        $topic = Topic::find($topic_id);
        $subtopic = Subtopic::find($subtopic_id);
        $user = User::find($user_id);

        $article = new Article;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $body = $request->file('body');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path('img/articles/featured'), $filename);
            
            $article->image = $filename;
        }
        $article->image_credit = $request->image_credit;
        $article->title = $request->title;
        $article->description = $request->description;
        $article->body = $request->body;
        $article->user()->associate($user);
        $article->topic()->associate($topic);
        $article->subtopic()->associate($subtopic);

        $article->save();
        $path = public_path('img/articles/' . sprintf("%06d", $article->id) . '-' . slug($article->title));
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $image->move($path . '/featured/', $filename, true);

        if(!empty($request->bodyimage)) {
            if(!File::isDirectory($path . '/body')) {
                File::makeDirectory($path . '/body', 0777, true, true);
            }
            $bodyimages = explode("|", $request->bodyimage);
            
           foreach($bodyimages as $bodyimage) {
               $im = public_path('file-manager/authors/' . slug($user->username) . '/' . $bodyimage);
               if(!File::isDirectory($im)) {
            File::makeDirectory($im, 0777, true, true);
        }
        $age = $path . '/body/' . $bodyimage ;
        $bodyimage->move($im, $age, true);
        dd('yes');
        
               //dump($im);
                 //dd($age);
               \File::copyDirectory($im, $age, true);
             
              
                
            } 
        }
        File::cleanDirectory(public_path('file-manager/authors/' . slug($user->username)));
        
        Session::flash('success', 'Article Created Successfully');
        return redirect()->route('articles.index');
        
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */

    public function read($slug)
    {
        // $article = Article::find($id);
        $article = Article::where([['title','LIKE','%'.$slug.'%'], ['editor_status', 'published']])->first();
        if(empty($article)) {
            Session::flash('error', 'Article Not Found');
            return redirect()->route('home');
        } else {
			$user = User::where('id',$article->user_id)->first();
            $nextarticle = Article::where('id', '>', $article->id)->first();
            $article->increment('view_count');
            $topicarticles = Article::orderBy('id', 'desc')->where('topic_id', $article->topic->id)->get()->except($article->id);
            $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
            $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
            return view('articles.read')->withArticle($article)->withNextarticle($nextarticle)->withActivesidebars($activesidebars)
                                ->withActivetopics($activetopics)->withTopicarticles($topicarticles)->withUser($user);
        }
        
    }

    public function topic_filter($slug) {
        $topic = Topic::where('name','LIKE','%'.$slug.'%')->first();
        // $topic = Topic::whereHas($slug)->first();
        $id = $topic->id;
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $topicarticles = Article::orderBy('id', 'desc')->where([['topic_id', $id], ['editor_status', 'published']])->paginate(10);
        return view('articles.topic_filter')->withTopicarticles($topicarticles)->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics)->withTopic($topic);        
    }

    public function latest_filter() {
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $articles = Article::orderBy('id', 'desc')->where('editor_status','published')->paginate(10);
        return view('articles.latest_filter')->withArticles($articles)->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics);        
    }

    public function popular_filter() {
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $articles = Article::orderBy('view_count', 'desc')->where('editor_status','published')->paginate(10);
        return view('articles.popular_filter')->withArticles($articles)->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics);        
    }

    // public function author_filter($name) {
    //     $user = User::where('name','LIKE','%'.$name.'%')->first();
    //     // $topic = Topic::whereHas($slug)->first();
    //     $id = $user->id;
    //     $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
    //     $activetopics = Topic::orderBy('id', 'asc')->where('status','active')->get();
    //     $authorarticles = Article::orderBy('id', 'desc')->where('user_id', $id)->get();
    //     return view('profiles.author')->withAuthorarticles($authorarticles)->withActivesidebars($activesidebars)
    //     ->withActivetopics($activetopics)->withTopic($topic)->withUser($user);        
    // }

    public function show($slug)
    {
        //
        $topics = Topic::orderBy('id', 'asc')->where('status','active')->get();
        $subtopics = Topic::orderBy('id', 'asc')->where('status','active')->get();

        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();

        $article = Article::where('title','LIKE','%'.$slug.'%')->first();
        $savecount = Readlist::where('articles_id', $article->id)->count();
        // $article = Article::find($id);

        // if(!empty($article->updated_at)) {
        //     $lastedit = (strtotime($article->updated_at) - strtotime($article->created_at))/1000;
        // }


        $topicarticles = Article::orderBy('id', 'desc')->where('topic_id', $article->topic->id)->get()->except($article->id);

        return view('articles.show', compact('article'))->withArticle($article)->withSavecount($savecount)
        ->withActivetopics($activetopics)->withActivesidebars($activesidebars)
        ->withTopics($topics)->withSubtopics($subtopics)->withTopicarticles($topicarticles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */

    // public function statusupdate(Request $request, $slug) {
    //     $article = Article::where('title','LIKE','%'.$slug.'%')->first();

    //     $this->validate($request, array(
    //         'editor_status' => 'in:pending,published,rejected'
    //     ));
        
    //     $article->editor_status = $request->editor_status;

    //     $article->save();

    //     Session::flash('success', 'Article Status Updated Successfully');
    //     return redirect()->route('articles.show', slug($article->title));

    // }

    public function update(Request $request, $slug)
    {
        //
        // $article = Article::find($id);
        $article = Article::where('title','LIKE','%'.$slug.'%')->first();

        $oldtitle = $article->title;

        $this->validate($request, array(
            'title' => 'required_without:editor_status|max:255',
            'description' => 'max:255',
            'topic' => 'required_without:editor_status|integer',
            'subtopic' => 'required_without:editor_status|integer',
            'body' => 'required_without:editor_status',
            'image' => 'sometimes|image',
            'image_credit' => 'sometimes|max:50',
            'editor_status' => 'in:pending,published,rejected',
        ),[
            'required_without' => 'The :attribute field is required',
        ]);

        if(!empty($request->editor_status)) {

            $article->editor_status = $request->editor_status;

            $article->save();

        } else {

            $user_id = $request->user;
            $topic_id = $request->topic;
            $subtopic_id = $request->subtopic;

            $topic = Topic::find($topic_id);
            $subtopic = Subtopic::find($subtopic_id);
            $user = User::find($user_id);

            // $article = new Article;

            $image = '';
            if($request->hasFile('image')) {

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                 // $image->move(public_path('img/articles/featured'), $filename);
                
                // $oldfilename = $article->image;
                // Storage::delete($oldfilename);

                $article->image = $filename;

            }

            $article->image_credit = $request->image_credit;
            $article->title = $request->title;
            $article->description = $request->description;
            $article->body = $request->body;
            $article->user()->associate($user);
            $article->topic()->associate($topic);
            $article->subtopic()->associate($subtopic);
            $article->editor_status = "pending";



            $article->save();

            $oldpath = public_path('img/articles/' . sprintf("%06d", $article->id) . '-' . slug($oldtitle));

            $path = public_path('img/articles/' . sprintf("%06d", $article->id) . '-' . slug($article->title));

            File::copyDirectory($oldpath . '/body/', public_path('file-manager/authors/' . slug($user->username)), true);
            File::copyDirectory($oldpath . '/featured/', public_path('file-manager/authors/' . slug($user->username)), true);

            File::deleteDirectory($oldpath);
            // File::cleanDirectory($oldpath . '/body/');
            if(!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            if(!empty($request->bodyimage)) {
                if(!File::isDirectory($path . '/body')) {
                    File::makeDirectory($path . '/body', 0777, true, true);
                }
                $bodyimages = explode("|", $request->bodyimage);
                foreach($bodyimages as $bodyimage) {
                    File::copyDirectory(public_path('file-manager/authors/' . slug($user->username) . '/' . $bodyimage), $path . '/body/' . $bodyimage, true);
                } 
            }

            if(!empty($image)) {
                $image->move($path . '/featured/', $filename, true);

            } else {
                if(!File::isDirectory($path . '/featured')) {
                    File::makeDirectory($path . '/featured', 0777, true, true);
                }
                File::copy(public_path('file-manager/authors/' . slug($user->username) . '/' . $article->image), $path . '/featured/' . $article->image, true);
            }


            File::cleanDirectory(public_path('file-manager/authors/' . slug($user->username)));

        }
        

        Session::flash('success', 'Article Updated Successfully');
        return redirect()->route('articles.show', slug($article->title));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $article = Article::where('title','LIKE','%'.$slug.'%')->first();
        
        // Storage::delete($article->image);
        $path = public_path('img/articles/' . sprintf("%06d", $article->id) . '-' . slug($article->title));
        File::deleteDirectory($path);

        $article->delete();
        
        Session::flash ('success', 'Article Deleted Successfully');
        return redirect()->route('articles.index');
    }
}
