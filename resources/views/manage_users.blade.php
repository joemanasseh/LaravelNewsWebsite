@extends('templates.master')

@section('title', 'IABC Africa - Manage Users')

@section('content')
    
    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="ui sixteen wide column">
                <div class="ui huge centered header">Manage Users</div>
                <div class="ui divider"></div>
                <div class="ui segment">
                    <div class="ui very padded stackable grid">
                        <!--  -->
                        <div class="two column row">
                            <div class="ui twelve wide column">
                                <div class="ui large centered header">All Users</div>
                                <div class="ui dummy-x-scroll mb-0">
                                    <table class="ui celled unstackable table"></table>
                                </div>
                                <div class="ui table x-scroll mt-0">
                                    <table class="ui celled unstackable table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Author</th>
                                                <th class="single line">
                                                    Created 
                                                    <i class="question circle icon"></i> 
                                                </th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($users) == 0)
                                        <tr>
                                            <td colspan="5">
                                                <div class="ui red centered header">No Users Found!</div>
                                            </td>
                                        </tr>
                                        @else
                                            @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    @if(Auth::user()->role == 'superadmin')
                                                    <a href="{{ route('profiles.user', $user->username) }}">
                                                    @endif
                                                        {{ $user->username }}
                                                    @if(Auth::user()->role == 'superadmin')
                                                    </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="mailto" href="">
                                                        {{ $user->email }}
                                                    </a>
                                                </td>
                                                <td>{{ ucfirst($user->role) }}</td>
                                                <td>@if(empty($user->author)) {{ __('#N/A') }} @else {{ $user->author }} @endif</td>
                                                <td class="single line">{{ ucwords(timeago($user->created_at)) }}</td>
                                                <td> <div class="ui basic orange label">Active</div> </td>
                                                <td class="single line"> 
                                                    <button class="ui blue icon button edit_user_button" data-tooltip="Edit Profile" data-id="{{ $user->id }}">
                                                        <i class="edit icon"></i>
                                                    </button>
                                                    <button class="ui grey icon button" data-tooltip="Disable User">
                                                        <i class="times icon"></i>
                                                    </button>

                                                    <!--  -->
                                                    <div class="ui tiny edit_user_modal {{ $user->id }} modal" data-id="{{ $user->role }}">
                                                        <i class="close icon"></i>
                                                        <div class="header">Edit User</div>
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
                                                            <form id="edit_user_form" class="ui form {{ $user->id }}" method="POST" action="{{route('users.update', $user->id)}}">
                                                                @csrf
                                                                {!! method_field('PUT') !!}
                                                                <div class="ui field @if ($errors->has('user_name')) error @endif">
                                                                    <label>Username</label>
                                                                    <input readonly id="user_name" type="text" name="user_name" placeholder="Name" value="{{ $user->username }}" autocomplete="user_name" required>
                                                                </div>

                                                                <div class="ui field @if ($errors->has('user_email')) error @endif">
                                                                    <label>Email Address</label>
                                                                    <input readonly id="user_email" type="text" name="user_email" placeholder="Email" value="{{ $user->email }}">
                                                                </div>

                                                                <div class="ui two fields">
                                                                    <div class="ui field @if ($errors->has('role')) error @endif">
                                                                        <label>Role</label>
                                                                        <div class="ui selection edit_user role_select {{ $user->id }} fluid dropdown" data-selected="{{ $user->role }}" data-id="{{ $user->id }}">
                                                                            <input name="role" type="hidden">
                                                                            <i class="dropdown icon"></i>
                                                                            <div class="default text">User Role</div>
                                                                            <div class="menu" >
                                                                                <div class="item" data-value="superadmin">{{ __('Superadmin') }}</div>
                                                                                <div class="item" data-value="admin">{{ __('Admin') }}</div>
                                                                                <div class="item" data-value="member">{{ __('Member') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="ui field @if ($errors->has('author')) error @endif">
                                                                        <label>Author</label>
                                                                        <div class="ui selection edit_user author_select {{ $user->id }} fluid dropdown" data-selected="{{ $user->author }}" data-id="{{ $user->id }}">
                                                                            <input name="author" type="hidden">
                                                                            <i class="dropdown icon"></i>
                                                                            <div class="default text">Author Privileges</div>
                                                                            <div class="menu" >
                                                                                <div class="item" data-value="{{ __('') }}">{{ __('#N/A') }}</div>
                                                                                <div class="item" data-value="{{ __('Editor') }}">{{ __('Editor') }}</div>
                                                                                <div class="item" data-value="{{ __('Senior Contributor') }}">{{ __('Senior Contributor') }}</div>
                                                                                <div class="item" data-value="{{ __('Contributor') }}">{{ __('Contributor') }}</div>
                                                                                <div class="item" data-value="{{ __('VIP Contributor') }}">{{ __('VIP Contributor') }}</div>
                                                                                <div class="item" data-value="{{ __('Guest Writer') }}">{{ __('Guest Writer') }}</div>
                                                                                <div class="item" data-value="{{ __('Freelancer') }}">{{ __('Freelancer') }}</div>
                                                                                <div class="item" data-value="{{ __('Writer') }}">{{ __('Writer') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                

                                                            </form>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="ui two column grid">
                                                                <div class="ui column">
                                                                    <div class="ui fluid approve orange button {{ $user->id }}">Submit Changes</div>
                                                                </div>
                                                                <div class="ui column">
                                                                    <div class="ui fluid cancel red button">Cancel Edit</div>
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

                                <!--  -->

                                
                                
                            </div>
                            <div class="four wide column">
                                <div class="ui large centered header">Create a User</div>
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
                                <form id="register" class="ui form" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="field @error('lastname') error @enderror">
                                        <label>Last Name</label>
                                        <input id="lastname" type="text" name="lastname" placeholder="Enter Last Name" value="{{ old('lastname') }}" autocomplete="lastname" required>
                                    </div>
                                    <div class="field @error('firstname') error @enderror">
                                        <label>First Name</label>
                                        <input id="firstname" type="text" name="firstname" placeholder="Enter First Name" value="{{ old('firstname') }}" autocomplete="firstname" required>
                                    </div>
                                    <div class="hidden eight wide computer sixteen wide mobile field @error('username') error @enderror">
                                        <label>Username</label>
                                        <input id="username" type="text" name="username" placeholder="e.g. surname_firstname" value="{{ old('username') }}" autocomplete="username" required>
                                    </div>
                                    <div class="field @error('email') error @enderror">
                                        <label>Email Address</label>
                                        <input id="email" type="email" name="email" placeholder="Enter valid email address" value="{{ old('email') }}" autocomplete="email" required>
                                    </div>
                                    <div class="field @error('password') error @enderror">
                                        <label>Password</label>
                                        <input id="password" type="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="field">
                                        <label>Confirm Password</label>
                                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Password" autocomplete="new-password" required>
                                    </div>

                                    <button class="ui orange large fluid button" type="submit">Create User</button>
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


$('.edit_user_button').click(function(e) {
    e.preventDefault();

    var user_id = $(this).attr('data-id');

    var role = $(this).siblings('.edit_user_modal').find('.role_select').attr('data-selected');
    $('.role_select.'+user_id).dropdown('set selected', role);

    var author = $(this).siblings('.edit_user_modal').find('.author_select').attr('data-selected');
    $('.author_select.'+user_id).dropdown('set selected', author);

    $('.edit_user_modal.'+user_id).modal({
        closable  : false,
        onApprove   : function(){
        $(this).find('.ui.approve.button').addClass('loading disabled').parent()
        .parent().find('.cancel').addClass('disabled');
        return false;
        }
    }).modal('show')
    .find('.ui.approve.button').click(function() {
        $('#edit_user_form.'+user_id).submit();
    });

    
});


$(function(){

    var table_width = $('.x-scroll>table.table').width();
    $('.dummy-x-scroll>table.table').css('width', table_width);

    $(".dummy-x-scroll").scroll(function(){
        $(".x-scroll")
            .scrollLeft($(".dummy-x-scroll").scrollLeft());
    });
    $(".x-scroll").scroll(function(){
        $(".dummy-x-scroll")
            .scrollLeft($(".x-scroll").scrollLeft());
    });
});



$('input#lastname').blur(function() {
    var lastname = $('input#lastname').val();
    var lastnames = lastname.replace(/\s+/g,' ').trim().split(' ');
    if(lastnames.length > 1) {
        lastnameCap =   (lastnames[0].charAt(0).toUpperCase() + lastnames[0].slice(1))
                        + '-' + 
                        (lastnames[1].charAt(0).toUpperCase() + lastnames[1].slice(1));
        $('input#lastname').val(lastnameCap);
    } else {
        lastnameCap = (lastnames[0].charAt(0).toUpperCase() + lastnames[0].slice(1));
        $('input#lastname').val(lastnameCap);
    }
});

$('input#firstname').blur(function() {
    var firstname = $('input#firstname').val();
    var firstnames = firstname.replace(/\s+/g,' ').trim().split(' ');
    if(firstnames.length > 1) {
        firstnameCap =   (firstnames[0].charAt(0).toUpperCase() + firstnames[0].slice(1));
        $('input#firstname').val(firstnameCap);
    } else {
        firstnameCap = (firstnames[0].charAt(0).toUpperCase() + firstnames[0].slice(1));
        $('input#firstname').val(firstnameCap);
    }
});

$('input#email').focus(function() {
    var lastname = $('input#lastname').val();
    var firstname = $('input#firstname').val();
    var time = (($.now()).toString(16)).slice(-5);
    $('input#username').val(lastname+'_'+firstname+'_'+time);
});


$('a.mailto').click(function(e) {
    e.preventDefault();
    $(this).attr('href', 'mailto:' + $.trim($(this).text()));
    $(this).removeClass('mailto').unbind('click').click();
});

@endsection
