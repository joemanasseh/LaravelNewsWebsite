<?php

namespace App\Http\Controllers;

use App\Sidebar;
use App\Topic;
use App\Article;
use Auth;
use Mail;
use Session;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'about', 'contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $mostrecentarticles = Article::orderBy('id', 'desc')->where('editor_status', 'published')->get();
        $mostpopulararticles = Article::orderBy('view_count', 'desc')->where('editor_status','published')->get();
        $articles = Article::inRandomOrder()->where('editor_status','published')->get();
        $articlecount = Article::where('editor_status', 'published')->count() - 1;
        return view('welcome')->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics)->withArticles($articles)->withArticlecount($articlecount)
        ->withMostrecentarticles($mostrecentarticles)->withMostpopulararticles($mostpopulararticles);
    }

    public function about()
    {
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        return view('pages.about')->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics);
    }

    public function contact()
    {
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        return view('pages.contact')->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics);
    }

    public function mail(Request $request) {
        $this->validate($request, array(
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
            // 'phone_no' => 'numeric',
            'subject' => 'required|in:Inquiry,Feedback,Complaint',
            'message' => 'required|min:10',
        ));

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            // 'phone_no' => $request->phone_no,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );

        Mail::send('emails.contact_us', $data, function($message) use ($data) {
            $message->from($data['email']);
            $message->to('contact_us@iabcafrica.com');
            $message->subject('Website Contact Us Form - ' . $data['subject']);
        });

        Session::flash('success', 'Message Sent Successfully');
        return redirect()->route('contact');
    }

    public function unauthorized()
    {
        $role = Auth::user()->role;
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $articles = Article::inRandomOrder()->get();
        return view('unauthorized')->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics)->withArticles($articles)
        ->withRole($role);
    }

    public function admin()
    {
        $role = Auth::user()->role;
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $articles = Article::inRandomOrder()->get();
        return view('admin_panel')->withActivesidebars($activesidebars)
        ->withActivetopics($activetopics)->withArticles($articles)
        ->withRole($role);
    }

    public function users()
    {
        $users = User::get();
        return view('users', compact('users'));
    }

    public function user($id)
    {
        $user = User::find($id);
        return view('usersView', compact('user'));
    }

    public function follwUserRequest(Request $request){


        $user = User::find($request->user_id);
        $response = auth()->user()->toggleFollow($user);


        return response()->json(['success'=>$response]);
    }

}



