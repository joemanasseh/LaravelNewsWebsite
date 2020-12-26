<?php

namespace App\Http\Controllers;

use App\Subtopic;
use App\Topic;
use App\Sidebar;
use Illuminate\Http\Request;
use Session;

class SubtopicController extends Controller
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
        $subtopics = Subtopic::orderBy('name', 'asc')->get();
        $topics = Topic::orderBy('name', 'asc')->get();
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $activetab = "subtopic";
        //$subtopicscript = " $('.topic_tab').removeClass('active').siblings('.subtopic_tab').addClass('active'); ";
        return view('manage_topics')->withActivesidebars($activesidebars)->withSubtopics($subtopics)->withTopics($topics)->withActivetab($activetab)->withActivetopics($activetopics);
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
            'subtopic_name' => 'required|max:50|min:2',
            'subtopic_status' => 'required|in:active,inactive'
        ));

        $subtopic = new Subtopic;
        $subtopic->name = $request->subtopic_name;
        $subtopic->status = $request->subtopic_status;

        $subtopic->save();

        if(strpos($request->subtopic_topics, ',')) {
            foreach(explode(',', $request->subtopic_topics) as $topic) {
                
                $topics = Topic::find([$topic]);
                $subtopic->topics()->attach($topics);
            }
    
        } else {

            $topic = $request->subtopic_topics;
            $topics = Topic::find([$topic]);
            $subtopic->topics()->attach($topics);
        }

        Session::flash('success', 'Subtopic Created Successfully');
        return redirect()->route('subtopics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function show(Subtopic $subtopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtopic $subtopic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $subtopic = Subtopic::find($id);

        $this->validate($request, array(
            'subtopic_status' => 'in:active,inactive',
            'subtopic_name' => 'max:50|min:2'
        ));


        if(!empty($request->subtopic_topics)) {
            
            $topics = Topic::get();
            $subtopic->topics()->detach($topics);

            if(strpos($request->subtopic_topics, ',')) {
                foreach(explode(',', $request->subtopic_topics) as $topic) {
                    
                    $topics = Topic::find([$topic]);
                    $subtopic->topics()->attach($topics);
                    $subtopic->name = $request->subtopic_name;
                }
        
            } else {
    
                $topic = $request->subtopic_topics;
                $topics = Topic::find([$topic]);
                $subtopic->topics()->attach($topics);
                $subtopic->name = $request->subtopic_name;

            }

        } else {

            $subtopic->status = $request->subtopic_status;

        }

        $subtopic->save();
        
        Session::flash('success', 'Subtopic Updated Succesfully');
        return redirect()->route('subtopics.index');


        //
        // $subtopic = Subtopic::find($id);

        // $this->validate($request, array(
        //     'subtopic_status' => 'in:active,inactive',
        // ));

        // $subtopic->status = $request->subtopic_status;

        // $subtopic->save();
        
        // Session::flash('success', 'Subtopic Updated Succesfully');
        // return redirect()->route('subtopics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $subtopic = Subtopic::find($id);

        $subtopic->delete();
        
        Session::flash ('success', 'Subtopic Deleted Successfully');
        return redirect()->route('subtopics.index');
    }
}
