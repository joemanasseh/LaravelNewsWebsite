<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Sidebar;
use App\User;
use App\Article;
use App\Socialmedia;
use Auth;
use Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Rules\maxwords;
use App\Rules\minwords;
use App\Rules\matchpass;
use App\Book;
use Storage;

class ProfileController extends Controller
{
    public function __construct() {

        $this->middleware('auth')->except('author');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function user($username)
    {
        $id = Auth::id();
        $authuser = User::find($id);
        $users = User::where('username','LIKE','%'.$username.'%')->get();

        if(empty($users) || (count($users) != 1)) {
            Session::flash('error', 'Profile Not Found');
            return redirect()->route('home');

        } else {

            $user = User::where('username','LIKE','%'.$username.'%')->first();

            if($id != $user->id && $authuser->role != 'superadmin') {
                Session::flash('error', 'Unauthorized Action');
                return redirect()->route('home');
            
            } else {

                $activetab = "profile";

                $authorarticles = Article::orderBy('id', 'desc')->where('user_id', $user->id)->get(); 

                $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
                $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
                return view('profiles.user')->withActivetopics($activetopics)->withUser($user)
                ->withActivesidebars($activesidebars)->withActivetab($activetab)->withAuthorarticles($authorarticles);
            }

        }
        
        
    }

    // public function user_update(Request $request, $id) {
        
    //     $user = User::find($id);


    //     $this->validate($request, array(
    //         'old_password' => [new matchpass],
    //         'password' => 'string|min:8|confirmed',
    //         'lastname' => 'min:2|max:50',
    //         'firstname' => 'min:2|max:50',
    //         'othername' => 'max:50',
    //         'gender' => 'in:male,female,unknown',
    //         'dob' => 'date',
    //         'about' => [new maxwords],
    //         'job_desc' => 'max:100',
    //         'photo' => 'sometimes|image',
    //     ));

    //     $user->password = Hash::make($request->password);
    //     $user->lastname = $request->lastname;
    //     $user->firstname = $request->firstname;
    //     $user->othername = $request->othername;
    //     $user->gender = $request->gender;
    //     $user->dob = $request->dob;
    //     $user->country = $request->country;
    //     $user->phone_no = $request->phone_no;
    //     $user->about = $request->about;
    //     $user->occupation = $request->occupation;
    //     $user->industry = $request->industry;
    //     $user->job_desc = $request->job_desc;

    //     if($request->hasFile('photo')) {
    //         $photo = $request->file('photo');
    //         $filename = time() . '.' . $photo->getClientOriginalExtension();
    //         $photo->move(public_path('img/users'), $filename);
            
    //         $article->photo = $filename;
    //     }
        
    //     $user->save();

    //     Session::flash('success', 'Profile Updated Successfully');
    //     return back();
    //     // return redirect()->route('profiles.user', $user->username);

    //     // return view('your-view')->withErrors($errors);

    // }

    // public function admin_user($name)
    // {
    //     // $id = Auth::id();
    //     $user = User::where('username','LIKE','%'.$name.'%')->first();
    //     $activetopics = Topic::orderBy('id', 'asc')->where('status','active')->get();
    //     $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
    //     return view('profiles.user')->withActivetopics($activetopics)->withUser($user)
    //     ->withActivesidebars($activesidebars);
    // }

    public function author($username)
    {
        $users = User::where('username',$username)->get();
        if(empty($users) || (count($users) != 1)) {
            Session::flash('error', 'Profile Not Found');
            return redirect()->back();
        } else {
            $user = User::where('username',$username)->first();
            $id = $user->id;
            $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
            $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
            $authorarticles = Article::orderBy('id', 'desc')->where('user_id', $id)->get();
            return view('profiles.author')->withActivetopics($activetopics)->withUser($user)
            ->withActivesidebars($activesidebars)->withAuthorarticles($authorarticles);
        }

        
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);


        $this->validate($request, array(
            'old_password' => [new matchpass],
            'password' => 'string|min:8|confirmed',
            'lastname' => 'min:2|max:50',
            'firstname' => 'min:2|max:50',
            'othername' => 'max:50',
            'gender' => 'in:Male,Female,Rather not Say',
            // 'dob' => 'date',
            'about' => [new maxwords],
            'job_desc' => 'max:100',
            'photo' => 'sometimes|image',
            // 
            'book_title' => 'required_with:book_author,isbn,book_cover,book_description',
            'book_author' => 'required_with:book_title,isbn,book_cover,book_description|min:2|max:50',
            'isbn' => 'sometimes|min:10|max:13',
            'book_cover' => 'sometimes|image',
            'book_description' => 'required_with:book_author,isbn,book_cover,book_title',
            'book_description' => [new minwords],
            // 
            'oldbook_author' => 'min:2|max:50',
            'oldisbn' => 'min:10|max:13',
            'oldbook_cover' => 'sometimes|image',
            'oldbook_description' => [new minwords],

            // 
            'social_app' => 'required_with:social_id,social_url|unique:socialmedia,app,NULL,id,user_id,'.$user->id,
            'social_id' => 'required_with:social_app,social_url',
            'social_url' => 'required_with:social_app,social_id',
            // 
            'oldsocial_app' => 'unique:socialmedia,app,NULL,id,user_id,'.$user->id,

        ));

        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if(!empty($request->lastname)) {
            $user->lastname = $request->lastname;
        }
        if(!empty($request->firstname)) {
            $user->firstname = $request->firstname;
        }
        if(!empty($request->othername)) {
            $user->othername = $request->othername;
        }
        if(!empty($request->gender)) {
            $user->gender = $request->gender;
        }
        if(!empty($request->dob)) {
            $user->dob = strtotime($request->dob);
        }
        if(!empty($request->country)) {
            $user->country = $request->country;
        }
        if(!empty($request->phone_no)) {
            $user->phone_no = $request->phone_no;
        }
        if(!empty($request->about)) {
            $user->about = $request->about;
        }
        if(!empty($request->occupation)) {
            $user->occupation = $request->occupation;
        }
        if(!empty($request->industry)) {
            $user->industry = $request->industry;
        }
        if(!empty($request->job_desc)) {
            $user->job_desc = $request->job_desc;
        }

        if($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $user->username . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/users'), $filename, true);
            
            $user->photo = $filename;
        }

        $user->save();

        

        if(!empty($request->book_title) || !empty($request->book_author) 
        || !empty($request->isbn) || !empty($request->book_description) ||
        $request->hasFile('book_cover')) {
            $book = new Book;

            if(!empty($request->book_title)) {
                $book->title = $request->book_title;
            }

            if(!empty($request->book_author)) {
                $book->author0 = $request->book_author;
            }

            if(!empty($request->isbn)) {
                $book->isbn = $request->isbn;
            }

            if(!empty($request->book_description)) {
                $book->description = $request->book_description;
            }

            if($request->hasFile('book_cover')) {
                $cover = $request->file('book_cover');
                $filename = slug($book->title). '-' . time() . '.' . $cover->getClientOriginalExtension();
                $cover->move(public_path('img/books'), $filename);
                
                $book->cover = $filename;
            }
            
            $book->user()->associate($user);

            $book->save();

        }

        if(!empty($request->oldbook_title) || !empty($request->oldbook_author) 
        || !empty($request->oldisbn) || !empty($request->oldbook_description) ||
        $request->hasFile('oldbook_cover')) {

            $book_id = $request->book_id;

            $book = Book::find($book_id);

            if(!empty($request->oldbook_title)) {
                $book->title = $request->oldbook_title;
            }

            if(!empty($request->oldbook_author)) {
                $book->author0 = $request->oldbook_author;
            }

            if(!empty($request->oldisbn)) {
                $book->isbn = $request->oldisbn;
            }

            if(!empty($request->oldbook_description)) {
                $book->description = $request->oldbook_description;
            }

            if($request->hasFile('oldbook_cover')) {
                $oldcover = $request->file('oldbook_cover');
                $newfilename = slug($book->title) . '-' . time() . '.' . $oldcover->getClientOriginalExtension();
                $oldcover->move(public_path('img/books'), $newfilename);

                $oldfilename = $book->cover;
                $book->cover = $newfilename;
                Storage::delete($oldfilename);
                
            }
            
            $book->save();

        }


        if(!empty($request->delete_book)) {
            
            $book = Book::find($request->delete_book);

            $user = User::find($book->user_id);
            
            Storage::delete($book->cover);

            $book->delete();
            
        }

        if(!empty($request->social_app)
        || !empty($request->social_id) || !empty($request->social_url)) {

            $socialmedia = new Socialmedia;

            if(!empty($request->social_icon)) {
                $socialmedia->icon = $request->social_icon;
            }

            if(!empty($request->social_app)) {
                $socialmedia->app = $request->social_app;
            }

            if(!empty($request->social_id)) {
                $socialmedia->username = $request->social_id;
            }

            if(!empty($request->social_url)) {
                $socialmedia->url = $request->social_url;
            }

            $socialmedia->user()->associate($user);

            $socialmedia->save();
            
        }


        if(!empty($request->oldsocial_app)
        || !empty($request->oldsocial_id) || !empty($request->oldsocial_url)) {

            $socialmedia_id = $request->socialmedia_id;

            $socialmedia = Socialmedia::find($socialmedia_id);

            if(!empty($request->oldsocial_icon)) {
                $socialmedia->icon = $request->oldsocial_icon;
            }

            if(!empty($request->oldsocial_app)) {
                $socialmedia->app = $request->oldsocial_app;
            }

            if(!empty($request->oldsocial_id)) {
                $socialmedia->username = $request->oldsocial_id;
            }

            if(!empty($request->oldsocial_url)) {
                $socialmedia->url = $request->oldsocial_url;
            }

            $socialmedia->save();
            
        }

        if(!empty($request->delete_socialmedia)) {
            
            $socialmedia = Socialmedia::find($request->delete_socialmedia);

            $user = User::find($socialmedia->user_id);
            
            $socialmedia->delete();
            
        }



        $activetab = "profile";

        Session::flash('success', 'Profile Updated Successfully');
        return back()->withActivetab($activetab);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
