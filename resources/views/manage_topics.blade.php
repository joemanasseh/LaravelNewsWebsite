@extends('templates.master')

@section('title', 'IABC Africa - Manage Topics & Subtopics')

@section('content')
    
    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="ui sixteen wide column">
                <div class="ui huge centered header">Manage Topics and Subtopics</div>
                <div class="ui divider"></div>
                <div class="ui top attached tabular two item menu active">
                    <a class="item topic_tab" data-tab="first">Manage Topics</a>
                    <a class="item subtopic_tab" data-tab="second">Manage Subtopics</a>
                </div>
                <div class="ui bottom attached tab segment topic_tab" data-tab="first">
                    <div class="ui very padded stackable grid">
                        <!--  -->
                        <div class="two column row">
                            <div class="ui twelve wide column">
                                <div class="ui large centered header">All Topics</div>
                                <div class="ui table x-scroll">
                                    <table class="ui celled unstackable table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Sidebar</th>
                                                <th>Subtopics</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($topics) == 0)
                                        <tr>
                                            <td colspan="5">
                                                <div class="ui red centered header">No Topics Found!</div>
                                            </td>
                                        </tr>
                                        @else
                                            @foreach($topics as $topic)
                                            <tr>
                                                <td>{{ $topic->name }}</td>
                                                <td>
                                                @if($topic->status == 'active')
                                                    <div class="ui green basic label">
                                                        Active
                                                    </div>
                                                @elseif($topic->status == 'inactive')
                                                    <div class="ui grey basic label">
                                                        Inactive
                                                    </div>
                                                @endif
                                                </td>
                                                <td>
                                                @if($topic->sidebar == 'visible')
                                                    <div class="ui blue basic label">
                                                        Visible
                                                    </div>
                                                @elseif($topic->sidebar == 'hidden')
                                                    <div class="ui grey basic label">
                                                        Hidden
                                                    </div>
                                                @endif
                                                </td>
                                                <td class="single line topic_subtopic_list">
                                                @if(count($topic->subtopics) == 0)
                                                    <div class="ui grey basic label">No subtopics</div>
                                                    <a href="google.com" class="ui basic icon button add_subtopic_button" data-id="{{ $topic->id }}" data-tooltip="Add Subtopics" data-position="top center">
                                                        <i class="orange plus icon"></i>
                                                    </a>
                                                @else
                                                @foreach($topic->subtopics as $subtopic)
                                                    <a class="ui orange basic label">{{ $subtopic->name }}</a>
                                                @endforeach
                                                    <a class="ui basic icon edit_topic_button button" data-id="{{ $topic->id }}" data-tooltip="Edit Topic" data-position="top center">
                                                        <i class="orange edit icon"></i>
                                                    </a>
                                                @endif
                                                <!--  -->
                                                    <div class="ui tiny edit_topic_modal {{ $topic->id }} modal" data-id="@foreach($topic->subtopics as $subtopic){{$subtopic->id}}@endforeach">
                                                        <i class="close icon"></i>
                                                        <div class="header">Edit Topic</div>
                                                        <div class="content">
                                                            @if(count($errors) > 0)
                                                            <div class="ui error message">
                                                                <i class="ui close icon"></i>
                                                                <div class="header">Please check your input</div>
                                                                <ul class="list">
                                                                    @foreach($errors->all() as $input_error)
                                                                    <li>{{ $input_error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                            <div class="ui success message">NB: You can also edit the topic's name here</div>
                                                            <form id="edit_topic_form" class="ui form {{ $topic->id }}" method="POST" action="{{route('topics.update', $topic->id)}}">
                                                                @csrf
                                                                {!! method_field('PUT') !!}
                                                                <div class="field @if ($errors->has('topic_name')) error @endif">
                                                                    <label>Name</label>
                                                                    <input type="text" name="topic_name" placeholder="Name" value="{{ $topic->name }}">
                                                                </div>
                                                                
                                                                <div class="ui field @if ($errors->has('topic_subtopics')) error @endif">
                                                                    <label>Subtopics</label>
                                                                    <div class="ui multiple search selection edit_topic subtopic_select {{ $topic->id }} fluid dropdown">
                                                                        <input name="topic_subtopics" type="hidden">
                                                                        <i class="dropdown icon"></i>
                                                                        <div class="default text">Subtopics</div>
                                                                        <div class="menu" >
                                                                            @foreach($subtopics as $subtopic)
                                                                            <div class="item" data-value="{{ $subtopic->id }}">{{ $subtopic->name }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="ui two column grid">
                                                                <div class="ui column">
                                                                    <div class="ui fluid approve orange button {{ $topic->id }}">Submit Changes</div>
                                                                </div>
                                                                <div class="ui column">
                                                                    <div class="ui fluid cancel red button">Cancel Edit</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="center aligned collapsing">
                                                    <div class="field">
                                                        <div class="ui toggle checkbox">
                                                            @if($topic->status == 'active')
                                                            <!-- <a data-tooltip="Set Inactive" data-position="top right"> -->
                                                            <input type="checkbox" name="status" tabindex="0" value="inactive" checked class="switch_topic_status"  data-html="Set Inactive" data-position="top right"">
                                                            <!-- </a> -->
                                                            @elseif($topic->status == 'inactive')
                                                            <input type="checkbox" name="status" tabindex="0" value="active" class="switch_topic_status" data-content="Set Active" data-position="top right">
                                                            @endif
                                                            <label class="d-inline"></label>
                                                            @if($topic->sidebar == 'visible')
                                                            <span class="ui blue icon switch_topic_sidebar_button button" data-id="hidden" data-tooltip="Hide on Sidebar" data-position="top right">
                                                                <i class="eye icon"></i>
                                                            </span>
                                                            @elseif($topic->sidebar == 'hidden')
                                                            <span class="ui grey icon switch_topic_sidebar_button button" data-id="visible" data-tooltip="Show on Sidebar" data-position="top right">
                                                                <i class="eye slash icon"></i>
                                                            </span>
                                                            @endif
                                                            
                                                            <span class="ui red icon delete_topic_button button {{ $topic->id }}" data-id="{{ $topic->id }}" data-tooltip="Delete Topic" data-position="top right">
                                                                <i class="times icon"></i>
                                                            </span>
                                                            <!--  -->
                                                            <form id="switch_topic_status_form" method="POST" action="{{route('topics.update', $topic->id)}}" hidden>
                                                                @csrf
                                                                {!! method_field('PUT') !!}
                                                                <input id="topic_status" type="text" name="topic_status" id="" value="">
                                                            </form>
                                                            <!--  -->
                                                            <form id="switch_topic_sidebar_form" method="POST" action="{{route('topics.update', $topic->id)}}" hidden>
                                                                @csrf
                                                                {!! method_field('PUT') !!}
                                                                <input id="topic_sidebar" type="text" name="sidebar" id="" value="">
                                                            </form>
                                                            <!--  -->
                                                            <form id="delete_topic_form" class="{{ $topic->id }}" action="{{route('topics.destroy', $topic->id)}}" method="post">
                                                                @csrf
                                                                {!! method_field('DELETE') !!}
                                                            </form>
                                                            <!--  -->
                                                            <div class="ui mini delete_topic_modal {{ $topic->id }} modal">
                                                                <i class="close icon"></i>
                                                                <div class="header">Delete Topic</div>
                                                                <div class="content">
                                                                    <div class="ui text">Are you sure you want to delete <b>{{ $topic->name }}</b>?</div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="ui approve green button">Yes, Delete</div>
                                                                    <div class="ui cancel red button">No, Cancel</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="four wide column">
                                <div class="ui large centered header">Create a Topic</div>
                                @if(count($errors) > 0)
                                <div class="ui error message">
                                    <i class="ui close icon"></i>
                                    <div class="header">Please check your input</div>
                                    <ul class="list">
                                        @foreach($errors->all() as $input_error)
                                        <li>{{ $input_error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form class="ui form" method="POST" action="{{route('topics.store')}}">
                                    @csrf
                                    <div class="field @if ($errors->has('topic_name')) error @endif">
                                        <label>Name</label>
                                        <input type="text" name="topic_name" placeholder="Name">
                                    </div>
                                    
                                    <div class="ui field @if ($errors->has('topic_subtopics')) error @endif">
                                        <label>Subtopics</label>
                                        <div class="ui multiple search selection subtopic_select fluid dropdown">
                                            <input name="topic_subtopics" type="hidden">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">Subtopics</div>
                                            <div class="menu">
                                                @foreach($subtopics as $subtopic)
                                                <div class="item" data-value="{{ $subtopic->id }}">{{ $subtopic->name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui two fields">
                                        <div class="field @if ($errors->has('status')) error @endif">
                                            <label for="">Status</label>
                                            <select name="topic_status" id="" class="ui dropdown">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <!--  -->
                                        <div class="field @if ($errors->has('sidebar')) error @endif">
                                            <label for="">Sidebar</label>
                                            <select name="sidebar" id="" class="ui dropdown">
                                                <option value="visible">Visible</option>
                                                <option value="hidden">Hidden</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    <button type="submit" class="ui fluid orange button">Create</button>
                                </form>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="ui bottom attached tab segment subtopic_tab" data-tab="second">
                    <div class="ui very padded stackable grid">
                        <!--  -->
                        <div class="two column row">
                            <div class="ui twelve wide column">
                                <div class="ui large centered header">All Subtopics</div>
                                <div class="ui table x-scroll">
                                    <table class="ui celled unstackable table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Topics</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($subtopics) == 0)
                                        <tr>
                                            <td colspan="4">
                                                <div class="ui red centered header">No Subtopics Found!</div>
                                            </td>
                                        </tr>
                                        @else
                                            @foreach($subtopics as $subtopic)
                                            <tr>
                                                <td>{{ $subtopic->name }}</td>
                                                <td>
                                                @if($subtopic->status == 'active')
                                                    <div class="ui green basic label">
                                                        Active
                                                    </div>
                                                @elseif($subtopic->status == 'inactive')
                                                    <div class="ui grey basic label">
                                                        Inactive
                                                    </div>
                                                @endif
                                                </td>
                                                <td>
                                                @if(count($subtopic->topics) == 0)
                                                    <div class="ui grey basic label">No topics</div>
                                                    <a class="ui basic icon button add_topic_button" data-id="{{ $subtopic->id }}" data-tooltip="Add Topics">
                                                        <i class="plus orange icon"></i>
                                                    </a>
                                                @else
                                                @foreach($subtopic->topics as $topic)
                                                    <a class="ui orange basic label">{{ $topic->name }}</a>
                                                @endforeach
                                                    <a class="ui basic icon edit_subtopic_button button" data-id="{{ $subtopic->id }}" data-tooltip="Edit Subtopic">
                                                        <i class="edit orange icon"></i>
                                                    </a>
                                                @endif
                                                <!--  -->
                                                <div class="ui tiny edit_subtopic_modal {{ $subtopic->id }} modal" data-id="@foreach($subtopic->topics as $topic){{$topic->id}}@endforeach">
                                                        <i class="close icon"></i>
                                                        <div class="header">Edit Subtopic</div>
                                                        <div class="content">
                                                            @if(count($errors) > 0)
                                                            <div class="ui error message">
                                                                <i class="ui close icon"></i>
                                                                <div class="header">Please check your input</div>
                                                                <ul class="list">
                                                                    @foreach($errors->all() as $input_error)
                                                                    <li>{{ $input_error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                            <div class="ui success message">NB: You can also edit the subtopic's name here</div>
                                                            <form id="edit_subtopic_form" class="ui form {{ $subtopic->id }}" method="POST" action="{{route('subtopics.update', $subtopic->id)}}">
                                                                @csrf
                                                                {!! method_field('PUT') !!}
                                                                <div class="field @if ($errors->has('subtopic_name')) error @endif">
                                                                    <label>Name</label>
                                                                    <input type="text" name="subtopic_name" placeholder="Name" value="{{ $subtopic->name }}">
                                                                </div>
                                                                
                                                                <div class="ui field @if ($errors->has('subtopic_topics')) error @endif">
                                                                    <label>Subtopics</label>
                                                                    <div class="ui multiple search selection edit_subtopic topic_select {{ $subtopic->id }} fluid dropdown">
                                                                        <input name="subtopic_topics" type="hidden">
                                                                        <i class="dropdown icon"></i>
                                                                        <div class="default text">Topics</div>
                                                                        <div class="menu" >
                                                                            @foreach($topics as $topic)
                                                                            <div class="item" data-value="{{ $topic->id }}">{{ $topic->name }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="ui two column grid">
                                                                <div class="ui column">
                                                                    <div class="ui fluid approve orange button {{ $subtopic->id }}">Submit Changes</div>
                                                                </div>
                                                                <div class="ui column">
                                                                    <div class="ui fluid cancel red button">Cancel Edit</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="center aligned collapsing">
                                                    <div class="ui field">
                                                        <div class="ui toggle checkbox">
                                                            @if($subtopic->status == 'active')
                                                            <input checked type="checkbox" name="status" tabindex="0" value="inactive" class="switch_subtopic_status" data-html="Set Inactive">
                                                            @elseif($subtopic->status == 'inactive')
                                                            <input type="checkbox" name="status" tabindex="0" value="active" class="switch_subtopic_status" data-html="Set Active">
                                                            @endif
                                                            <label class="d-inline"></label>
                                                            <span class="ui red icon delete_subtopic_button button {{ $subtopic->id }}" data-id="{{ $subtopic->id }}" data-tooltip="Delete Subtopic" data-position="top right">
                                                                <i class="times icon"></i>
                                                            </span>
                                                            <!--  -->
                                                            <form id="switch_subtopic_status_form" method="POST" action="{{route('subtopics.update', $subtopic->id)}}" hidden>
                                                                @csrf
                                                                {!! method_field('PUT') !!}
                                                                <input id="subtopic_status" type="text" name="subtopic_status" id="" value="">
                                                            </form>
                                                            <!--  -->
                                                            <form id="delete_subtopic_form" class="{{ $subtopic->id }}" action="{{route('subtopics.destroy', $subtopic->id)}}" method="post">
                                                                @csrf
                                                                {!! method_field('DELETE') !!}
                                                            </form>
                                                            <!--  -->
                                                            <div class="ui mini delete_subtopic_modal {{ $subtopic->id }} modal">
                                                                <i class="close icon"></i>
                                                                <div class="header">Delete Subtopic</div>
                                                                <div class="content">
                                                                    <div class="ui text">Are you sure you want to delete <b>{{ $subtopic->name }}</b></div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="ui approve green button">Yes, Delete</div>
                                                                    <div class="ui cancel red button">No, Cancel</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="four wide column">
                                <div class="ui large centered header">Create a Subtopic</div>
                                @if(count($errors) > 0)
                                <div class="ui error message">
                                    <i class="ui close icon"></i>
                                    <div class="header">Please check your input</div>
                                    <ul class="list">
                                        @foreach($errors->all() as $input_error)
                                        <li>{{ $input_error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form class="ui form" method="POST" action="{{route('subtopics.store')}}">
                                    @csrf
                                    
                                    <div class="field @if ($errors->has('name')) error @endif">
                                        <label>Name</label>
                                        <input type="text" name="subtopic_name" placeholder="Name">
                                    </div>

                                    <div class="field @if ($errors->has('subtopic_topics')) error @endif">
                                        <label>Topics</label>
                                        <div class="ui multiple search selection topic_select fluid dropdown">
                                            <input name="subtopic_topics" type="hidden">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">Topics</div>
                                            <div class="menu">
                                                @foreach($topics as $topic)
                                                <div class="item" data-value="{{ $topic->id }}">{{ $topic->name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="ui two fields">
                                        <div class="field @if ($errors->has('status')) error @endif">
                                            <label for="">Status</label>
                                            <select name="subtopic_status" id="" class="ui dropdown">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <!--  -->
                                        <div class="field">
                                            <label for="" class="text-white">Submit</label>
                                            <button type="submit" class="ui fluid orange button">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('custom_script')

@if($activetab == "topic")

    $('.topic_tab').addClass('active');

@elseif($activetab == "subtopic")

    $('.subtopic_tab').addClass('active');

@endif

$('.menu .item').tab();



// For Topic


// $('.topic_status').dropdown('set selected', 'boy');$('.topic_status').dropdown('set selected', 'boy');

$('.topic_status').dropdown({
    setSelected: 'boy'
});

$('input.switch_topic_status').click(function() {
    var status = $(this).attr('value');
    $(this).attr('disabled','true');
    $(this).siblings('.delete_topic_button, .switch_topic_sidebar_button').addClass('disabled');
    $(this).siblings('#switch_topic_status_form').find('input#topic_status').attr('value',status);
    $(this).siblings('#switch_topic_status_form').submit();
});


$('.switch_topic_sidebar_button').click(function(e) {
    e.preventDefault();
    var sidebar = $(this).attr('data-id');
    $(this).addClass('disabled');
    $(this).siblings('.switch_topic_status').attr('disabled','true').siblings('.delete_topic_button').addClass('disabled');
    $(this).siblings('#switch_topic_sidebar_form').find('input#topic_sidebar').attr('value',sidebar)
    .parent('#switch_topic_sidebar_form').submit();
    
});


$('.edit_topic_button, .add_subtopic_button').click(function(e) {
    e.preventDefault();
    var topic_id = $(this).attr('data-id');
    $('.edit_topic_modal.'+topic_id).modal({
        closable  : false,
        onApprove   : function(){
        $(this).find('.ui.approve.button').addClass('loading disabled').parent()
        .parent().find('.cancel').addClass('disabled');
        return false;
        }
    }).modal('show')
    .find('.ui.approve.button').click(function() {
        $('#edit_topic_form.'+topic_id).submit(); 
    });
    var selected = $('.edit_topic_modal.'+topic_id).attr('data-id');
    
    for (i = 0; i < selected.length; i++) {
        $('.edit_topic.subtopic_select.'+topic_id).dropdown( 'set selected', selected[i] );
    }
    
});

$('.delete_topic_button').click(function(e) {
    e.preventDefault();
    var topic_id = $(this).attr('data-id');
    $('.delete_topic_modal.'+topic_id).modal('show')
    .find('.ui.approve.button').click(function() {
        $('.delete_topic_button.'+topic_id).addClass('disabled loading')
        .siblings('.switch_topic_status').attr('disabled','true').siblings('.switch_topic_sidebar_button').addClass('disabled');
        $('#delete_topic_form.'+topic_id).submit();
    });
    
});

//End For Topic


//For Subtopic



$('input.switch_subtopic_status').click(function() {
    var status = $(this).attr('value');
    $(this).attr('disabled','true');
    $(this).siblings('.delete_subtopic_button').addClass('disabled');
    $(this).siblings('#switch_subtopic_status_form').children('input#subtopic_status').attr('value',status)
    .parent('#switch_subtopic_status_form').submit();
});


$('.edit_subtopic_button, .add_topic_button').click(function(e) {
    e.preventDefault();
    var subtopic_id = $(this).attr('data-id');
    $('.edit_subtopic_modal.'+subtopic_id).modal({
        closable  : false,
        onApprove   : function(){
        $(this).find('.ui.approve.button').addClass('loading disabled').parent()
        .parent().find('.cancel').addClass('disabled');
        return false;
        }
    }).modal('show')
    .find('.ui.approve.button').click(function() {
        $('#edit_subtopic_form.'+subtopic_id).submit();
    });
    var selected = $('.edit_subtopic_modal.'+subtopic_id).attr('data-id');
    
    for (i = 0; i < selected.length; i++) {
        $('.edit_subtopic.topic_select.'+subtopic_id).dropdown( 'set selected', selected[i] );
    }
    
});


$('.delete_subtopic_button').click(function(e) {
    e.preventDefault();
    var subtopic_id = $(this).attr('data-id');
    $('.delete_subtopic_modal.'+subtopic_id).modal('show')
    .find('.ui.approve.button').click(function() {
        $('.delete_subtopic_button.'+subtopic_id).addClass('disabled loading')
        .siblings('.switch_subtopic_status').attr('disabled','true');
        $('#delete_subtopic_form.'+subtopic_id).submit()
        .parents('td').addClass('loading');
    });
    
});


//End For Subtopic
@endsection