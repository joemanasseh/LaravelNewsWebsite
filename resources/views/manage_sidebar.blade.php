@extends('templates.master')

@section('title', 'IABC Africa - Manage Sidebar Menu')

@section('content')
    
    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="ui sixteen wide center aligned column">
                <div class="ui huge header">Manage Sidebar</div>
                <div class="ui divider"></div>
            </div>

            <div class="two column row">
                <div class="ui eleven wide column">
                    <div class="ui large centered header">All Sidebar Menu Items</div>
                    <div class="ui table x-scroll">
                        <table class="ui celled unstackable table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(empty($sidebars))
                            <tr>
                                <td colspan="4">
                                    <div class="ui red centered header">No Menu Items Found!</div>
                                </td>
                            </tr>
                            
                            @else
                                @foreach($sidebars as $sidebar)
                                <tr>
                                    <td>{{ $sidebar->name }}</td>
                                    <td>{{ $sidebar->link }}</td>
                                    <td>
                                    @if($sidebar->status == 'active')
                                        <div class="ui green basic label">
                                            Active
                                        </div>
                                    @elseif($sidebar->status == 'inactive')
                                        <div class="ui grey basic label">
                                            Inactive
                                        </div>
                                    @endif
                                    </td>
                                    <td class="center aligned collapsing">
                                        <div class="field">
                                            <div class="ui toggle checkbox">
                                                @if($sidebar->status == 'active')
                                                <input type="checkbox" name="status" tabindex="0" value="inactive" checked class="switch_sidebar_status">
                                                @elseif($sidebar->status == 'inactive')
                                                <input type="checkbox" name="status" tabindex="0" value="active" class="switch_sidebar_status">
                                                @endif
                                                <label class="d-inline"></label>

                                                <form id="switch_sidebar_status_form" method="POST" action="{{route('sidebars.update', $sidebar->id)}}}" hidden>
                                                    @csrf
                                                    {!! method_field('PUT') !!}
                                                    <input id="status" type="text" name="status" id="" value="">
                                                </form>

                                                <span class="ui blue icon edit_sidebar_button button {{ $sidebar->id }}" data-id="{{ $sidebar->id }}">
                                                    <i class="edit icon"></i>
                                                </span>
                                                
                                                <div class="ui tiny edit_sidebar_modal {{ $sidebar->id }} modal">
                                                    <i class="close icon"></i>
                                                    <div class="header">Edit Sidebar Menu Item</div>
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
                                                        <form id="edit_sidebar_form" class="ui form {{ $sidebar->id }}" method="POST" action="{{ route('sidebars.update', $sidebar->id) }}">
                                                            @csrf
                                                            {!! method_field('PUT') !!}
                                                            <div class="field @if ($errors->has('name')) error @endif">
                                                                <label>Name</label>
                                                                <input type="text" name="name" placeholder="Name" value="{{ $sidebar->name }}">
                                                            </div>
                                                            <div class="field @if ($errors->has('link')) error @endif">
                                                                <label>Link</label>
                                                                <input type="text" name="link" value="{{ $sidebar->link }}" placeholder="https://iabc_africa.com/...">
                                                            </div>
                                                            <input type="hidden" name="oldstatus" value="{{ $sidebar->status }}">
                                                        </form>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="ui two column grid">
                                                            <div class="ui column">
                                                                <div class="ui fluid approve orange button">Submit Changes</div>
                                                            </div>
                                                            <div class="ui column">
                                                                <div class="ui fluid cancel red button">Cancel Edit</div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="ui approve orange button">Submit Changes</div>
                                                        <div class="ui cancel red button">Cancel Edit</div> -->
                                                    </div>
                                                </div>

                                                <!--  -->

                                                <span class="ui red icon delete_sidebar_button button {{ $sidebar->id }}" data-id="{{ $sidebar->id }}">
                                                    <i class="times icon"></i>
                                                </span>

                                                
                                                <!--  -->
                                                
                                                
                                                <!--  -->

                                                <form id="delete_sidebar_form" class="{{ $sidebar->id }}" action="{{route('sidebars.destroy', $sidebar->id)}}" method="post">
                                                    @csrf
                                                    {!! method_field('DELETE') !!}
                                                </form>
                                                <!--  -->
                                                <div class="ui mini delete_sidebar_modal {{ $sidebar->id }} modal">
                                                    <i class="close icon"></i>
                                                    <div class="header">Delete Sidebar Menu Item</div>
                                                    <div class="content">
                                                        <div class="ui text">Are you sure you want to delete <b>{{ $sidebar->name }}</b> ?</div>
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
                <div class="five wide column">
                    <div class="ui large centered header">Create a Sidebar Menu Item</div>
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
                    <form class="ui form" method="POST" action="{{route('sidebars.store')}}">
                        @csrf
                        <div class="field @if ($errors->has('name')) error @endif">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name">
                        </div>
                        
                        <div class="field @if ($errors->has('link')) error @endif">
                            <label>Link</label>
                            <div class="ui labeled input">
                                <div class="ui label">
                                    iabcafrica.com/
                                </div>
                                <input type="text" name="link" placeholder="">
                            </div>
                        </div>
                        
                        
                        <div class="ui two fields">
                            <div class="field @if ($errors->has('status')) error @endif">
                                <label for="">Status</label>
                                <select name="status" id="" class="ui dropdown">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            
                            <div class="field">
                                <label for="" class="text-white">Submit</label>
                                <button type="submit" class="ui fluid orange button">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    

@endsection

@section('custom_script')

$('input.switch_sidebar_status').click(function() {
    var status = $(this).attr('value');
    $(this).attr('disabled','true');
    $(this).siblings('.delete_sidebar_button').addClass('disabled');
    $(this).siblings('#switch_sidebar_status_form').find('input#status').attr('value',status);
    $(this).siblings('#switch_sidebar_status_form').submit();
});

$('.edit_sidebar_button').click(function(e) {
    e.preventDefault();
    var sidebar_id = $(this).attr('data-id');
    $('.edit_sidebar_modal.'+sidebar_id).modal({
        closable : false,
        onApprove : function() {
            $(this).find('.ui.approve.button').addClass('loading disabled').parent()
            .parent().find('.cancel').addClass('disabled');
            return false;
        }
    }).modal('show')
    .find('.ui.approve.button').click(function() {
        $('#edit_sidebar_form.'+sidebar_id).submit();
    });
});

$('.delete_sidebar_button').click(function(e) {
    e.preventDefault();
    var sidebar_id = $(this).attr('data-id');
    $('.delete_sidebar_modal.'+sidebar_id).modal('show')
    .find('.ui.approve.button').click(function() {
        $('.delete_sidebar_button.'+sidebar_id).addClass('loading')
        .siblings('input.switch_sidebar_status').attr('disabled','true');
        $('#delete_sidebar_form.'+sidebar_id).submit();
    });
    
});

@endsection