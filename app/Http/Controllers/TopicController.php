<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Sidebar;
use App\Subtopic;
use Illuminate\Http\Request;
use Session;

class TopicController extends Controller
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
        $topics = Topic::orderBy('name', 'asc')->get();
        $subtopics = Subtopic::orderBy('name', 'asc')->get();
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $activetab = "topic";
        return view('manage_topics')->withActivesidebars($activesidebars)
        ->withTopics($topics)->withSubtopics($subtopics)->withActivetab($activetab)->withActivetopics($activetopics);
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
        $this->validate($request, array(
            'topic_name' => 'required|max:50|min:2',
            'topic_status' => 'required|in:active,inactive',
            'sidebar' => 'required|in:visible,hidden',
        ));

        $topic = new Topic;
        $topic->name = $request->topic_name;
        $topic->status = $request->topic_status;
        $topic->sidebar = $request->sidebar;

        $topic->save();
        
        if(strpos($request->topic_subtopics, ',')) {
            foreach(explode(',', $request->topic_subtopics) as $subtopic) {
                
                $subtopics = Subtopic::find([$subtopic]);
                $topic->subtopics()->attach($subtopics);
            }
    
        } else {

            $subtopic = $request->topic_subtopics;
            $subtopics = Subtopic::find([$subtopic]);
            $topic->subtopics()->attach($subtopics);
        }

        Session::flash('success', 'Topic Created Successfully');
        return redirect()->route('topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
        
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $topic = Topic::find($id);

        $this->validate($request, array(
            'topic_status' => 'in:active,inactive',
            'sidebar' => 'in:visible,hidden',
            'topic_name' => 'max:50|min:2'
        ));


        if(!empty($request->topic_subtopics)) {
            
            $subtopics = Subtopic::get();
            $topic->subtopics()->detach($subtopics);

            if(strpos($request->topic_subtopics, ',')) {
                foreach(explode(',', $request->topic_subtopics) as $subtopic) {
                    
                    $subtopics = Subtopic::find([$subtopic]);
                    $topic->subtopics()->attach($subtopics);
                    $topic->name = $request->topic_name;
                }
        
            } else {
    
                $subtopic = $request->topic_subtopics;
                $subtopics = Subtopic::find([$subtopic]);
                $topic->subtopics()->attach($subtopics);
                $topic->name = $request->topic_name;

            }

        } else {

            if($request->topic_status == '') {
                $topic->sidebar = $request->sidebar;
            } else if($request->sidebar == '') {
                $topic->status = $request->topic_status;
            }

        }

        

        $topic->save();
        
        Session::flash('success', 'Topic Updated Succesfully');
        return redirect()->route('topics.index');
    }

    // public function update2(Request $request, $id)
    // {
    //     //
    //     $topic = Topic::find($id);

    //     $this->validate($request, array(
    //         'topic_name' => 'required|max:50|min:2'
    //     ));

        

    //     $topic->sidebar = 'visible';


    //     $topic->save();

    //     if(strpos($request->topic_subtopics, ',')) {
    //         foreach(explode(',', $request->topic_subtopics) as $subtopic) {
                
    //             $subtopics = Subtopic::find([$subtopic]);
    //             $topic->subtopics()->attach($subtopics);
    //         }
    
    //     } else {

    //         $subtopic = $request->topic_subtopics;
    //         $subtopics = Subtopic::find([$subtopic]);
    //         $topic->subtopics()->attach($subtopics);
    //     }
        
    //     Session::flash('success', 'Topic Updated Succesfully');
    //     return redirect()->route('topics.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $topic = Topic::find($id);

        $topic->delete();
        
        Session::flash ('success', 'Topic Deleted Successfully');
        return redirect()->route('topics.index');
    }
}
