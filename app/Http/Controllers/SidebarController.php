<?php

namespace App\Http\Controllers;

use App\Sidebar;
use App\Topic;
use Illuminate\Http\Request;
use Session;


class SidebarController extends Controller
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
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        $sidebars = Sidebar::orderBy('id', 'desc')->get();
        return view('manage_sidebar')->withSidebars($sidebars)->withActivesidebars($activesidebars)->withActivetopics($activetopics);;
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
            'name' => 'required|max:50|min:2',
            'link' => 'required|max:100|min:2|unique:sidebars,link',
            'status' => 'required|in:active,inactive'
        ));

        $sidebar = new Sidebar;
        $sidebar->name = $request->name;
        $sidebar->link = $request->link;
        $sidebar->status = $request->status;

        $sidebar->save();

        Session::flash('success', 'Sidebar Menu Item was Successfully Added');
        return redirect()->route('sidebars.index');
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
        $sidebar = Sidebar::find($id);

        if(!empty($request->oldstatus)) {

            $this->validate($request, array(
                'name' => 'required|max:50|min:2',
                'link' => 'required|max:100|min:2|unique:sidebars,link,'.$sidebar->id,
                'oldstatus' => 'required|in:active,inactive'
            ));

            $sidebar->name = $request->name;
            $sidebar->link = $request->link;
            $sidebar->status = $request->oldstatus;

        } else {

            $this->validate($request, array(
                'status' => 'required|in:active,inactive'
            ));

            $sidebar->status = $request->status;

        }

        $sidebar->save();
        
        Session::flash('success', 'Status succesfully Updated');
        return redirect()->route('sidebars.index');
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
        $sidebar = Sidebar::find($id);

        $sidebar->delete();
        
        Session::flash ('success', 'Sidebar Menu Item successfully Deleted');
        return redirect()->route('sidebars.index');
    }
}
