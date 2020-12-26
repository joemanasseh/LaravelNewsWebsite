<?php

namespace App\Http\Controllers;

use App\Readlist;
use Auth;
use App\Article;
use App\User;
use Session;
use Illuminate\Http\Request;

class ReadlistController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $user_id = Auth::id();
        // $user = User::find($user_id);
    
        // $readlist = Readlist::orderBy('id', 'asc')->get();

        // $article = Article::orderBy('id', 'asc')->get();

        // $articulate = Article::find([5,6,7]);

        // return view('readlist_test')->withUser($user)->withReadlist($readlist)
        // ->withArticulate($articulate)->withArticle($article);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // $this->validate($request, array(
        //     'title' => 'required|max:255',
        //     'description' => 'max:255',
        //     'topic' => 'required|integer',
        //     'subtopic' => 'required|integer',
        //     'body' => 'required',
        //     'image' => 'sometimes|image'
            
        // ));

        $user_id = Auth::id();
        $article_id = $request->article_id;

        $oldreadlist = Readlist::where('user_id', $user_id)->where('articles_id', $article_id)->get();

        if(count($oldreadlist) != 0) {
            Session::flash('error', 'Article Already Exists in Readlist');
            return redirect()->back();
        }

        $user = User::find($user_id);
        $article = Article::find($article_id);

        $readlist = new Readlist;

        $readlist->user()->associate($user);
        $readlist->articles()->associate($article);

        $readlist->save();

        // $readlist->articles()->attach($article_id);

        Session::flash('success', 'Article Successfully Saved to Readlist');
        return redirect()->back();
    }

    public function detach(Request $request, $id)
    {
        // $readlist = Readlist::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Readlist  $readlist
     * @return \Illuminate\Http\Response
     */
    public function show(Readlist $readlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Readlist  $readlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Readlist $readlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Readlist  $readlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Readlist $readlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Readlist  $readlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $readlist = Readlist::find($id);

        $readlist->delete();

        $activetab = "readlist";
        
        Session::flash ('success', 'Article Succesfully Removed From Readlist');
        return back()->withActivetab($activetab);
    }
}
