@extends('templates.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
@endsection

@section('title', 'IABC Afirca - User Profile')

@section('content')
    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="ui sixteen wide column">
                <div class="ui huge centered header">Profile Details</div>
                <div class="ui divider"></div>
                <div class="ui top attached tabular orange menu">
                    <a class="item" data-tab="profile">Basic Info</a>
                    <a class="item" data-tab="readlist">Readlist</a>
                    <a href="" class="item" data-tab="article">Articles</a>
                </div>
                <div class="ui bottom attached tab segment border border-orange pb-0" data-tab="profile">
                    <div class="ui icon message">
                        <i class="ui close icon"></i>
                        <i class="ui info icon"></i>
                        <div class="content">
                            Click the <b>"Update Profile"</b> Button at the Bottom of the Page to Commit All Changes Made
                        </div>
                    </div>
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
                    <form id="update_form" class="ui large form" method="POST" action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    {!! method_field('PUT') !!} 
                        <div class="ui stackable grid">
                            <div class="ui twelve wide column">
                                <div class="ui orange dividing header">
                                    <div class="content">
                                        Account Information
                                    </div>
                                </div>

                                <!--  -->

                                <div class="three fields">
                                    <div class="field">
                                        <label class="ui small header">Username</label>
                                        <div class="ui fluid icon input">
                                            <input disabled type="text" class="border border-orange opaque" value="{{ $user->username }}">
                                            <i class="circular inverted edit link icon"></i>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="ui small header">Email Address</label>
                                        <div class="ui fluid icon input">
                                            <input disabled type="email" class="border border-orange opaque" value="{{ $user->email }}">
                                            <i class="circular inverted edit icon"></i>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="ui small header">Password</label>
                                        <div class="ui fluid icon input">
                                            <input disabled id="db_password" type="password" class="border border-orange opaque" value="{{ $user->password }}">
                                            <i class="circular inverted password edit @if(Auth::id() == $user->id) link @endif icon"></i>
                                            <div class="ui mini password modal">
                                                <i class="close icon"></i>
                                                <div class="header">Change Password</div>
                                                <div class="content">
                                                    <label class="ui small black header mb-0">Old Password</label>
                                                    <div class="ui fluid large input">
                                                        <input data-id="old_password" type="password" class="" value="">
                                                    </div>
                                                    <!--  -->
                                                    <label class="ui small black header mb-0">New Password</label>
                                                    <div class="ui fluid large input">
                                                        <input data-id="password" type="password" class="" value="">
                                                    </div>
                                                    <!--  -->
                                                    <label class="ui small black header mb-0">Confirm New Password</label>
                                                    <div class="ui fluid large input">
                                                        <input data-id="password-confirm" type="password" class="" value="">
                                                    </div>
                                                    <!--  -->
                                                </div>
                                                <div class="actions">
                                                    <div class="ui approve green button">Done</div>
                                                    <div class="ui cancel red button">Cancel</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!--  -->
                                <div class="ui orange dividing header">Personal Information</div>
                                <!--  -->
                                <div class="four fields">
                                    <div class="field @if ($errors->has('lastname')) error @endif">
                                        <label class="ui small header">Last Name</label>
                                        <div class="ui fluid icon input">
                                        @if(!empty($user->lastname))
                                            <input id="lastname" disabled type="text" class="border border-orange opaque" value="{{ $user->lastname }}">
                                            <i class="circular inverted lastname edit link icon"></i>
                                        @else
                                            <input type="text" name="lastname" placeholder="Surname" value="">
                                        @endif
                                        </div>
                                    </div>
                                    <div class="field @if ($errors->has('firstname')) error @endif">
                                        <label class="ui small header">First Name</label>
                                        <div class="ui fluid icon input">
                                        @if(!empty($user->firstname))
                                            <input id="firstname" disabled type="text" class="border border-orange opaque" value="{{ $user->firstname }}">
                                            <i class="circular inverted firstname edit link icon"></i>
                                        @else
                                            <input type="text" name="firstname" placeholder="First Name" value="">
                                        @endif
                                        </div>
                                    </div>
                                    <div class="field @if ($errors->has('othername')) error @endif">
                                        <label class="ui small header">Other Names / Initials</label>
                                        <div class="ui fluid icon input">
                                        @if(!empty($user->othername))
                                            <input id="othername" disabled type="text" class="border border-orange opaque" value="{{ $user->othername }}">
                                            <i class="circular inverted othername edit link icon"></i>
                                        @else
                                            <input type="text" name="othername" placeholder="Other Names" value="">
                                        @endif
                                        </div>
                                    </div>
                                    <div class="field @if ($errors->has('gender')) error @endif">
                                        <label class="ui small header">Gender</label>
                                        @if(!empty($user->gender))
                                        <div class="ui fluid icon input">
                                            <input id="gender" class="border border-orange opaque" disabled type="text" value="{{ $user->gender }}">
                                            <i class="circular inverted gender edit link icon"></i>
                                        </div>
                                        @else
                                        <select class="ui fluid dropdown" name="gender">
                                            <option value="">Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Rather not Say">Rather not Say</option>
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                <!--  -->
                                <div class="three fields">
                                    <div class="field @if ($errors->has('dob')) error @endif">
                                        <label class="ui small header">Date of Birth</label>
                                        @if(!empty($user->dob))
                                        <div class="ui fluid icon input">
                                            <input id="dob" disabled type="text" class="border border-orange opaque" value="{{ date('F j, Y', $user->dob) }}">
                                            <i class="circular inverted dob edit link icon"></i>
                                        </div>
                                        @else
                                        <div id="dob0" class="ui fluid calendar">
                                            <div class="ui labeled icon input">
                                                <div class="ui icon label">
                                                    <i class="calendar alternate icon"></i>
                                                </div>
                                                <input type="text" placeholder="Date of Birth" name="dob" value="">
                                            </div>
                                        </div>
                                        @endif
                                        <!-- </div> -->
                                    </div>
                                    <div class="field @if ($errors->has('country')) error @endif">
                                        <label class="ui small header">Nationality</label>
                                        @if(!empty($user->country))
                                        <div class="ui fluid icon input">
                                            <input id="country" disabled type="text" class="border border-orange opaque" value="{{ $user->country }}">
                                            <i class="circular inverted country edit link icon"></i>
                                        </div>
                                        @else
                                        <div class="ui fluid search selection country dropdown">
                                            <input type="hidden" name="country">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">Select Country</div>
                                            <div class="menu">
                                                @include('variables._country')
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="field @if ($errors->has('phone_no')) error @endif">
                                        <label class="ui small header">Phone Number</label>
                                        <div class="ui fluid icon input">
                                        @if(!empty($user->phone_no))
                                            <input id="phone_no" disabled type="text" class="border border-orange opaque" value="{{ $user->phone_no }}">
                                            <i class="circular inverted phone_no edit link icon"></i>
                                        @else
                                            <input type="text" placeholder="Phone Number" name="phone_no" class="" value="">
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="two fields">
                                    <div class="field @if ($errors->has('about')) error @endif" style="position: relative">
                                        <label for="" class="ui small header">About Me</label>
                                        @if(!empty($user->about))
                                        <div class="ui icon input">
                                            <div id="about" class="ui fluid segment mt-0 border border-orange w-100 faketextarea">
                                                {!! $user->about !!}
                                            </div>
                                            <i class="circular inverted about edit link icon"></i>
                                        </div>
                                        
                                        <!-- <div class="ui icon input" style="position: absolute; opacity: 0.5">
                                            <textarea disabled id="about" id="" cols="30" class="border border-orange opaque" style="max-height:25px !important;"></textarea>
                                            <i class="circular inverted about edit link icon opaque"></i>
                                        </div> -->
                                        @else
                                        <div class="ui icon input">
                                            <textarea id="abouteditor" name="about" class="w-100 rounded" style="max-height:25px !important;"></textarea>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="field @if ($errors->has('social')) error @endif">
                                        <label for="" class="ui small header">Social Media</label>
                                        @if(count($user->socialmedias) != 0)
                                        <div class="ui segment mt-0">
                                            <div class="ui four column grid">
                                                @foreach($user->socialmedias as $socialmedia)
                                                <div class="ui center aligned socialmedia column" data-id="{{ $socialmedia->id }}">
                                                    <div class="ui compact menu">
                                                        <div class="center aligned item border border-orange rounded p-10">
                                                            <a href="https://{{ $socialmedia->url }}" style="width: 42px;">
                                                                <i class="ui large circular {{ $socialmedia->icon }} link icon"></i>
                                                            </a>
                                                            <a class="ui floating circular icon orange label socialmedia info" data-id="{{ $socialmedia->id }}">
                                                                <i class="info icon"></i>
                                                            </a>
                                                        </div>
														
														<div class="ui mini socialmedia info modal" data-id="{{ $socialmedia->id }}">
															<i class="close icon"></i>
															<div class="header">
																Social Media Account
																<div class="ui right floated tiny red button mt_5 delete socialmedia mr-20" data-id="{{ $socialmedia->id }}">Delete</div>
																<div class="ui mini delete_socialmedia_modal modal" data-id="{{ $socialmedia->id }}">
																	<i class="close icon"></i>
																	<div class="header">Delete Social Media</div>
																	<div class="content">
																		<div class="ui text">Are you sure you want to delete this social media account?</div>
																	</div>
																	<div class="actions">
																		<div class="ui approve green button">Yes, Delete</div>
																		<div class="ui cancel red button">No, Cancel</div>
																	</div>
																</div>
															</div>
															<div class="scrolling content">
																<label class="ui small black header mb-1">Website / App</label>
																<div class="ui fluid icon input mb-20">
																	<input id="oldsocial_app" disabled type="text" class="border border-orange opaque" value="{{ $socialmedia->app }}" data-icon="{{ $socialmedia->icon }}">
																	<i class="circular inverted oldsocial_app edit link icon mt05"></i>
																</div>


																<label class="ui small black header mb-1">ID / Username</label>
																<div class="ui fluid icon input mb-20">
																	<input id="oldsocial_id" disabled type="text" class="ui fluid border border-orange opaque" value="{{ $socialmedia->username }}">
																	<i class="circular inverted oldsocial_id edit link icon mt05"></i>
																</div>
																
																<label class="ui small black header mb-1">URL</label>
																<div class="ui fluid labeled action input mb-20 w-100">
																	<div class="ui label">
																		https://
																	</div>
																	<div class="ui icon input fluid w-100">
																		<input id="oldsocial_url" disabled type="text" class="ui fluid input border border-orange opaque" value="{{ $socialmedia->url }}">
																		<i class="circular inverted oldsocial_url edit link icon mt05"></i>
																	</div>
																	<div class="ui disabled icon button">
																		<i class="blue external alternate socialurl link icon" data-content="Test URL"></i>
																	</div>
																</div>
															</div>
															<div class="actions">
																<div class="ui orange approve button hidden">Submit Changes</div>
																<div class="ui cancel button">Close</div>
																<!-- <div class="ui cancel button">Delete</div> -->
															</div>
														</div>
                                                    </div>

                                                    
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <div class="ui orange add social button">Add Social Media Account</div>
                                        
                                        <div class="ui mini add social modal">
                                            <i class="close icon"></i>
                                            
                                            <div class="header">Add Social Media Account</div>
                                            <div class="scrolling content">

                                                <label class="ui small black header mb-1">Website / App</label>
                                                <div class="ui fluid social selection dropdown mb-20">
                                                    <input type="hidden" data-id="social_app">
                                                    <i class="dropdown icon"></i>
                                                    <div class="default text">Social Media</div>
                                                    <div class="menu">
                                                        <div class="item" data-value="Facebook" data-text="Facebook">
                                                            <i class="bordered facebook f icon"></i>
                                                            Facebook
                                                        </div>
                                                        <div class="item" data-value="LinkedIn" data-text="LinkedIn">
                                                            <i class="bordered linkedin in icon"></i>
                                                            LinkedIn
                                                        </div>
                                                        <div class="item" data-value="Twitter" data-text="Twitter">
                                                            <i class="bordered twitter icon"></i>
                                                            Twitter
                                                        </div>
                                                        <div class="item" data-value="Pinterest" data-text="Pinterest">
                                                            <i class="bordered pinterest p icon"></i>
                                                            Pinterest
                                                        </div>
                                                        <div class="item" data-value="Instagram" data-text="Instagram">
                                                            <i class="bordered instagram icon"></i>
                                                            Instagram
                                                        </div>
                                                        <div class="item" data-value="YouTube" data-text="YouTube">
                                                            <i class="bordered youtube icon"></i>
                                                            YouTube
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  -->
                                                <label class="ui small black header mb-1">ID / Username</label>
                                                <div class="ui fluid disabled input mb-20">
                                                    <input data-id="social_id" type="text" class="" value="">
                                                </div>
                                                <!--  -->
                                                <label class="ui small black header mb-1">URL</label>
                                                <div class="ui fluid labeled action input mb-20">
                                                    <div class="ui label">
                                                        https://
                                                    </div>
                                                    <input data-id="social_url" type="text" class="" value="">
                                                    <div class="ui icon button">
                                                        <i class="blue external alternate socialurl link icon" data-content="Test URL"></i>
                                                    </div>
                                                </div>
                                                <!--  -->
                                            </div>
                                            <div class="actions">
                                                <div class="ui approve green button">Done</div>
                                                <div class="ui cancel red button">Cancel</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui orange dividing header">Professional Information</div>
                                <!--  -->
                                <div class="three fields">
                                    <div class="four wide field">
                                        <label class="ui small header">Occupational Status</label>
                                        @if(!empty($user->occupation))
                                        <div class="ui fluid icon input">
                                            <input id="occupation" disabled type="text" class="border border-orange opaque" value="{{ $user->occupation }}">
                                            <i class="circular inverted occupation edit link icon"></i>
                                        </div>
                                        @else
                                        <select class="ui fluid search selection occupation dropdown" name="occupation">
                                            <option value="">Career Status</option>
                                            <option value="Student">Student</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Business Owner">Business Owner</option>
                                            <option disabled value="Other">Other? Type In</option>
                                        </select>
                                        @endif
                                    </div>

                                    <div class="six wide field">
                                        <label class="ui small header">Industry</label>
                                        @if(!empty($user->industry))
                                        <div class="ui fluid icon input">
                                            <input id="industry" disabled type="text" class="border border-orange opaque" value="{{ $user->industry }}">
                                            <i class="circular inverted industri edit link icon"></i>
                                        </div>
                                        @else
                                        <select class="ui fluid dropdown" name="industry">
                                            @include('variables._industry')
                                        </select>
                                        @endif
                                    </div>
                                    
                                    <div class="six wide field">
                                        <label class="ui small header">Job Description</label>
                                        <div class="ui fluid icon input">
                                        @if(!empty($user->job_desc))
                                            <input id="job_desc" disabled type="text" class="border border-orange opaque" value="{{ $user->job_desc }}">
                                            <i class="circular inverted job_desc edit link icon"></i>
                                        @else
                                            <input name="job_desc" type="text" placeholder="e.g. Managing Director, JUMIA NG" class="" value="">
                                        @endif
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label class="ui small header">Educational Qualifications</label>
                                        @if(!empty($user->education))
                                        <div class="ui basic segment border border-orange rounded mt-0"></div>
                                        @endif
                                        <div class="ui orange button">Add Education</div>
                                    </div>
                                    <div class="field">
                                        <label class="ui small header">Professional Memberships</label>
                                        @if(!empty($user->membership))
                                        <div class="ui basic segment border border-orange rounded mt-0"></div>
                                        @endif
                                        <div class="ui orange button">Add Membership</div>
                                    </div>
                                    <!-- <div class="field">
                                        <label class="ui small header">Educational Qualifications</label>
                                        <div class="ui fluid input">
                                        @if(!empty($user->education))
                                            <input id="game" disabled type="text" class="border border-orange opaque" value="{{ $user->education }}">
                                        @else
                                            <input type="text" placeholder="e.g. B.Sc, M.Sc, Ph.D" class="" value="">
                                        @endif
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="four wide column">
                                <div class="ui orange dividing header">Profile Photo</div>
                                <div class="ui field @if($errors->has('photo')) error @endif">
                                    @if(!empty($user->photo))
                                    <div class="form-group">
                                        <div class="fileinput w-100 mb-0 fileinput-exists" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail w-100 ui rounded field-border">
                                                <img src="{{ asset('img/ui/head.jpg') }}" class="img-fluid" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail w-100 lh-0" style="">
                                                <img src="{{ asset('img/users/' . $user->photo )}}" class="border border-orange rounded">
                                            </div>
                                            <div>
                                                <span class="btn-default btn-file">
                                                    <span class="fileinput-new ui button file-click left floated">Select Image</span>
                                                    <span class="fileinput-exists ui button file-click left floated">Change</span>
                                                    <input type="hidden" value="" name=""><input name="photo" type="file">
                                                </span>
                                                <a href="#pablo" class="ui red icon button fileinput-exists" data-dismiss="fileinput">
                                                    <i class="times icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    @else
                                    <!--  -->
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail w-100 ui rounded field-border">
                                                <img src="{{ asset('img/ui/head.jpg') }}" class="img-fluid" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail lh-0"></div>
                                            <div>
                                                <span class="btn-default btn-file">
                                                    <span class="fileinput-new ui button file-click left floated">Select Image</span>
                                                    <span class="fileinput-exists ui button file-click left floated">Change</span>
                                                    <input name="photo" type="file" />
                                                </span>
                                                <a href="#pablo" class="ui red icon button fileinput-exists" data-dismiss="fileinput">
                                                    <i class="times icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!--  -->
                                <div class="ui orange dividing header">Books</div>
                                <div class="ui two column grid">
                                    @foreach($user->books as $book)
                                    <div class="column book_thumbnail" data-id="{{ $book->id }}">
                                        <div class="ui fluid image border border-orange rounded">
                                            <img src="{{ asset('img/books/' . $book->cover )}}" alt="" class="ui small fluid image rounded">
                                            <a class="ui floating circular icon orange label book info" data-id="{{ $book->id }}">
                                                <i class="info icon"></i>
                                            </a>
                                        </div>
                                        <div class="ui mini book info modal" data-id="{{ $book->id }}">
                                            <i class="close icon"></i>
                                            <div class="header">
                                                Book Details
                                                <div class="ui right floated tiny red button mt_5 delete book mr-20" data-id="{{ $book->id }}">Delete Book</div>
                                                <div class="ui mini delete_book_modal modal" data-id="{{ $book->id }}">
                                                    <i class="close icon"></i>
                                                    <div class="header">Delete Book</div>
                                                    <div class="content">
                                                        <div class="ui text">Are you sure you want to delete this book?</div>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="ui approve green button">Yes, Delete</div>
                                                        <div class="ui cancel red button">No, Cancel</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scrolling content">
                                                <div class="ui field">
                                                    <label class="ui small header">Book Title</label>
                                                    <div class="ui fluid icon input mt-5">
                                                        <input id="oldbook_title" disabled type="text" class="border border-orange opaque" value="{{ $book->title }}">
                                                        <i class="circular inverted oldbook_title edit link icon mt05"></i>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <!--  -->
                                                <div class="ui field">
                                                    <label class="ui small header">Author</label>
                                                    <div class="ui fluid icon input mt-5">
                                                        <input id="oldbook_author" disabled type="text" class="border border-orange opaque" value="{{ $book->author0 }}">
                                                        <i class="circular inverted oldbook_author edit link icon mt05"></i>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <!--  -->
                                                <div class="ui field @if($errors->has('oldbook_cover')) error @endif">
                                                    <label class="ui small header">Book Cover</label>
                                                    <div class="form-group bookinfo mt-5">
                                                        <div class="fileinput w-100 mb-0 fileinput-exists" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail w-100 ui rounded field-border">
                                                                <img src="{{ asset('img/books/book.jpg') }}" class="img-fluid" alt="...">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail w-100 lh-0" style="">
                                                                <img src="{{ asset('img/books/' . $book->cover )}}" class="border border-orange rounded">
                                                            </div>
                                                            <div>
                                                                <span class="btn-default btn-file">
                                                                    <span class="fileinput-new ui button file-click left floated">Select Image</span>
                                                                    <span class="fileinput-exists ui button file-click left floated">Change</span>
                                                                    <input type="hidden" value="" name="" class="cover"><input data-id="oldbook_cover" type="file">
                                                                </span>
                                                                <a href="#pablo" class="ui red icon button fileinput-exists" data-dismiss="fileinput">
                                                                    <i class="times icon"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <!--  -->
                                                <div class="ui field">
                                                    <label class="ui small header">ISBN</label>
                                                    <div class="ui fluid icon input mt-5">
                                                        <input id="oldisbn" disabled type="text" class="border border-orange opaque" value="{{ $book->isbn }}">
                                                        <i class="circular inverted oldisbn edit link icon mt05"></i>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <!--  -->
                                                <div class="field @if ($errors->has('book_description')) error @endif">
                                                    <label for="" class="ui small header">Book Description</label>
                                                    <div class="ui fluid form icon input mt-5">
                                                        <textarea disabled id="oldbook_description" id="" cols="30" class="border border-orange opaque" style="max-height:25px !important;">{{ $book->description }}</textarea>
                                                        <i class="circular inverted oldbook_description edit link icon"></i>
                                                    </div>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div class="actions">
                                                <div class="ui orange approve button hidden">Submit Changes</div>
                                                <div class="ui cancel button">Close</div>
                                                <!-- <div class="ui cancel button">Delete</div> -->
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <br>
                                <div class="ui add book button orange button">Add Book</div>
                                <div class="ui mini add book modal">
                                    <i class="close icon"></i>
                                    <div class="header">Add Book</div>
                                    <div class="scrolling content">
                                        <label class="ui small black header mb-1">Book Title</label>
                                        <div class="ui fluid input mb-20">
                                            <input data-id="book_title" type="text" class="" value="">
                                        </div>
                                        <!--  -->
                                        <label class="ui small black header mb-1">Author</label>
                                        <div class="ui fluid input mb-20">
                                            <input data-id="book_author" type="text" class="" value="">
                                        </div>
                                        <!--  -->
                                        <label class="ui small black header mb-1">Book Cover</label>
                                        <div class="form-group book mb-25">
                                            <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail w-100 ui rounded field-border">
                                                    <img src="{{ asset('img/ui/book_cover_placeholder.jpg') }}" class="img-fluid" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail lh-0" style="line-height: none !important;"></div>
                                                <div>
                                                    <span class="btn-default btn-file">
                                                        <span class="fileinput-new ui button file-click left floated">Select Image</span>
                                                        <span class="fileinput-exists ui button file-click left floated">Change</span>
                                                        <input data-id="book_cover" type="file" />
                                                    </span>
                                                    <a href="#pablo" class="ui red icon button fileinput-exists remove_bookcover" data-dismiss="fileinput">
                                                        <i class="times icon"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <label class="ui small black header mb-1">ISBN</label>
                                        <div class="ui fluid input mb-20">
                                            <input data-id="isbn" type="text" class="" value="">
                                        </div>
                                        <!--  -->
                                        <div class="ui form">
                                            <label class="ui small black header mb-1 ">Book Description</label>
                                            <div class="ui fluid input">
                                                <textarea data-id="book_description" cols="30" style="max-height:25px !important;"></textarea>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                    <div class="actions">
                                        <div class="ui approve green button">Done</div>
                                        <div class="ui cancel red button">Cancel</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="ui huge fluid orange button mt-50 mb-15">Update Profile</button>
                    </form>
                </div>
                <div class="ui bottom attached tab segment border border-orange" data-tab="readlist">
                    <div class="ui orange dividing header">Saved Articles</div>
                    <!-- <div class="ui red header">No Articles Saved Yet!</div> -->
                    @if(count($user->readlists) < 1)
                    <div class="ui red header mt-0">No Articles Saved!</div>
                    @else
                    <div class="ui stackable grid">
                    @foreach($user->readlists as $readlist)
                        <div class="ui four wide column">
                            <div class="ui fluid card border border-orange">
                                <div class="ui image">
                                    <img src="{{ asset('img/articles/' . sprintf('%06d', $readlist->articles->id) . '-' . slug($readlist->articles->title) . '/featured/' . $readlist->articles->image) }}" alt="">
                                </div>
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($readlist->articles->topic->name)) }}" class="ui tiny blue text uppercase">
                                        {{ $readlist->articles->topic->name }}
                                    </a>
                                    <a href="{{ route('articles.read', slug($readlist->articles->title)) }}">
                                        <div class="ui small header mt-5">{{ $readlist->articles->title }}</div>
                                    </a>
                                </div>
                                <div class="ui bottom attached content py-0">
                                    <div class="ui basic horizontal segments">
                                        <div class="ui vertically fitted segment">
                                            <i class="user icon"></i>
                                            <a href="{{ route('profiles.author', slug($readlist->articles->user->username)) }}">
                                                {{ $readlist->articles->user->lastname.' '.$readlist->articles->user->firstname[0].'.' }}
                                            </a>
                                        </div>
                                        <div class="ui vertically fitted segment">
                                            <i class="book reader icon"></i>
                                            {{ round(str_word_count($readlist->articles->body) / 250) }} mins
                                        </div>
                                    </div>
                                </div>
                                <div class="ui top attached basic orange remove readlist button" data-id="{{ $readlist->id }}">Remove from Readlist</div>
                                <div class="ui mini remove readlist modal" data-id="{{ $readlist->id }}">
                                    <i class="close icon"></i>
                                    <div class="header">Remove Readlist Article</div>
                                    <div class="content">
                                        <div class="ui text">Are you sure you want to remove this article from your readlist?</div>
                                    </div>
                                    <div class="actions">
                                        <div class="ui approve green button">Yes, Remove</div>
                                        <div class="ui cancel red button">No, Cancel</div>
                                    </div>
                                </div>
                                <form id="remove_readlist_form" class="{{ $readlist->id }}" action="{{ route('readlists.destroy', $readlist->id) }}" method="post">
                                    @csrf
                                    {!! method_field('DELETE') !!}
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @endif
                </div>
                <div class="ui bottom attached tab segment border border-orange" data-tab="article">
                    <div class="ui orange dividing header">Written By Me</div>
                @if(!empty($user->author))
                    @if(count($authorarticles) != 0)
                        <div class="ui stackable grid">
                            @foreach($authorarticles as $authorarticle)
                            <div class="ui four wide column">
                                <div class="ui fluid card border border-orange">
                                    <div class="ui image">
                                        <span class="ui right corner label">
                                            @if($authorarticle->editor_status == 'pending')
                                            <i class="sync alternate icon" data-content="Pending"></i>
                                            @elseif($authorarticle->editor_status == 'published')
                                            <i class="green check mark icon" data-content="Published"></i>
                                            @elseif($authorarticle->editor_status == 'rejected')
                                            <i class="red times icon" data-content="Rejected"></i>
                                            @else
                                            <i class="question mark"></i>
                                            @endif
                                        </span>
                                        <img src="{{ asset('img/articles/' . sprintf('%06d', $authorarticle->id) . '-' . slug($authorarticle->title) . '/featured/' . $authorarticle->image) }}" alt="">
                                    </div>
                                    <div class="content">
                                        <a href="{{ route('topic.articles', slug($authorarticle->topic->name)) }}" class="ui tiny blue text uppercase">
                                            {{ $authorarticle->topic->name }}
                                        </a>
                                        <a href="{{ route('articles.read', slug($authorarticle->title)) }}">
                                            <div class="ui small header mt-5">{{ $authorarticle->title }}</div>
                                        </a>
                                    </div>
                                    <div class="ui bottom attached content py-0">
                                        <div class="ui basic horizontal segments">
                                            <div class="ui vertically fitted segment">
                                                <i class="user icon"></i>
                                                <a href="{{ route('profiles.author', slug($authorarticle->user->username)) }}">
                                                    {{ $authorarticle->user->lastname.' '.$authorarticle->user->firstname[0].'.' }}
                                                </a>
                                            </div>
                                            <div class="ui vertically fitted segment">
                                                <i class="book reader icon"></i>
                                                {{ round(str_word_count($authorarticle->body) / 250) }} mins
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <a class="ui floating circular icon orange label socialmedia info" data-id="{{ $authorarticle->id }}">
                                        <i class="info icon"></i>
                                    </a> -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    @else
                        <div class="ui red centered header">No Articles Found!</div>
                    @endif
                    <a href="{{ route('articles.create') }}" class="ui orange button mt-10">Write An Article</a>
                @else
                    <div class="ui orange button">Write for Us</div>
                @endif
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="{{ asset('js/ckeditor.js') }}"></script> -->
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>


@endsection


@section('custom_script')


$('.menu .item').tab();

@if($activetab == "readlist")

    $('[data-tab="readlist"]').addClass('active');

@elseif($activetab == "profile")

    $('[data-tab="profile"]').addClass('active');

@elseif($activetab == "article")

    $('[data-tab="article"]').addClass('active');

@endif

$('#dob0').calendar({
    type: 'date'
});

$('.country.dropdown').dropdown({
    forceSelection: false,
});



if(($('textarea#abouteditor').length)) {
    var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector: "textarea#abouteditor",
        // height: tinyheight - 23,
        toolbar_drawer: 'sliding',
        menubar: false,
        branding: false,
        //image_dimensions: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime table paste code help wordcount'
        ],
        toolbar: 'undo redo | bold italic underline | link blockquote | bullist numlist outdent indent | removeformat | help',
        relative_urls: false,
        
        setup: function(editor) {
            editor.on('init', function() {
                
            });
        }

    };

    tinymce.init(editor_config);

    // ClassicEditor
    //     .create( document.querySelector( '#abouteditor' ), {
    //         toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo'],
    //     } )
    //     .then( editor => {
    //         aboutEditor = editor;
    //     } )
    //     .catch( error => {
    //         console.error( error );
    //     } );
}


//ClassicEditor
//    .create( document.querySelector( '#abouteditor' ), {
//        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
//        heading: {
//            options: [
//                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
//                { model: 'heading3', view: 'h3', title: 'Heading', class: 'ck-heading_heading3' },
//                { model: 'heading4', view: 'h4', title: 'Sub Heading', class: 'ck-heading_heading4' }
//            ]
//        }
//    } )
//    .then( editor => {
//        aboutEditor = editor;
//    } )
//    .catch( error => {
//        console.error( error );
//    } );



$('.occupation.dropdown').dropdown({
    forceSelection: false,
    allowAdditions: true,
    hideAddtions: false,
});

$('.socialmedia.column').find('.link.icon').hover(
    function() {
        $(this).addClass('orange inverted')
    },
    function() {
        $(this).removeClass('orange inverted')
    }
);


$('.ui.modal').modal();
$('.password.edit').click(function() {
    $('.password.modal').modal({
        onApprove : function() {
            var oldpassword = $('input[data-id="old_password"]').val();
            var password = $('input[data-id="password"]').val();
            var passwordconfirm = $('input[data-id="password-confirm"]').val();
            $('.password.edit').parent().children().addClass('hidden show');
            $('.password.edit').parent().append(`
                <input id="old_password" class="hidden" type="password" name="old_password" value="`+oldpassword+`" required>
                <input readonly id="password" class="" type="password" name="password" value="`+password+`" required>
                <i class="password circular inverted undo link icon"></i>
                <input id="password-confirm" class="hidden" type="password" name="password_confirmation" value="`+passwordconfirm+`" required>
            `);
            //return false;
            $('.password.undo').click(function() {
                $(this).parent().children().not('.show').not('i').remove();
                $(this).parent().children('.show').removeClass('hidden show');
                $(this).remove();
            });
        }
    }).modal('show');
    
});

$('.lastname.edit').click(function(e) {
    e.preventDefault();
    var lastname = $(this).siblings('input#lastname').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="lastname" placeholder="Surname" value="`+lastname+`">
        <i class="circular inverted lastname undo link icon"></i>
    `);
    $(this).addClass('hidden show');
    $('.lastname.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.firstname.edit').click(function(e) {
    e.preventDefault();
    var firstname = $(this).siblings('input#firstname').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="firstname" placeholder="First Name" value="`+firstname+`">
        <i class="circular inverted firstname undo link icon"></i>
    `);
    $(this).addClass('hidden');
    $('.firstname.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.othername.edit').click(function(e) {
    e.preventDefault();
    var othername = $(this).siblings('input#othername').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="othername" placeholder="Other Names" value="`+othername+`">
        <i class="circular inverted othername undo link icon"></i>
    `);
    $(this).addClass('hidden');
    $('.othername.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.gender.edit').click(function(e) {
    e.preventDefault();
    var gender = $(this).siblings('input#gender').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <select class="ui fluid dropdown" name="gender" value="`+gender+`">
            <option value="">Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Rather not Say">Rather not Say</option>
        </select>
        <i class="circular inverted gender undo link icon"></i>
    `);
    $(this).parent().children('select').dropdown('set selected', gender);
    $(this).addClass('hidden');
    $('.gender.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.dob.edit').click(function(e) {
    e.preventDefault();
    var dob = $(this).siblings('input#dob').val();
    $(this).parents('.field').children().not('label').addClass('hidden');
    $(this).parents('.field').append(`
    <div id="dob1" class="ui fluid calendar">
        <div class="ui fluid labeled icon input">
            <div class="ui icon label">
                <i class="calendar alternate icon"></i>
            </div>
            <input type="text" placeholder="Date of Birth" name="dob" value="`+dob+`">
            <i class="circular inverted dob undo link icon"></i>
        </div>
    </div>
    `);
    $('#dob1').calendar({
        type: 'date'
    });
    $('.dob.undo').click(function() {
        $(this).parents('.field').find('.hidden').removeClass('hidden');
        $(this).parents('.calendar').remove();
    });
});


$('.country.edit').click(function(e) {
    e.preventDefault();
    var country = $(this).siblings('input#country').val();
    $(this).parents('.field').children().not('label').addClass('hidden');
    $(this).parents('.field').append(`
        <div class="ui fluid search selection country dropdown">
            <input type="hidden" name="country">
            <i class="circular inverted country undo link undo icon" style="position:absolute; right:.2em; top:.30em; z-index: 3; opacity:.5;" ></i>
            <div class="default text">Select Country</div>
            <div class="menu">
                @include('variables._country')
            </div>
        </div>
    `);
    $('.country.dropdown').dropdown({
        forceSelection: false,
    });
    $('.country.dropdown').dropdown('set selected', country);
    $('.country.undo').click(function() {
        $(this).parents('.field').find('.hidden').removeClass('hidden');
        $(this).parents('.dropdown').remove();
    });
});


$('.phone_no.edit').click(function(e) {
    e.preventDefault();
    var phone_no = $(this).siblings('input#phone_no').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="phone_no" placeholder="Phone Number" value="`+phone_no+`">
        <i class="circular inverted phone_no undo link icon"></i>
    `);
    $(this).addClass('hidden');
    $('.phone_no.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.about.edit').click(function(e) {
    e.preventDefault();
    var about = $(this).siblings('div#about.faketextarea').html();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <textarea id="abouteditor" name="about" class="w-100 rounded" placeholder="About Me" style="max-height: 25px !important;">`+about+`</textarea>
        <i class="circular inverted about undo link icon"></i>
    `);
    // ClassicEditor
    //     .create( document.querySelector( '#abouteditor' ), {
    //         toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo'],
    //     } )
    //     .then( editor => {
    //         aboutEditor = editor;
    //     } )
    //     .catch( error => {
    //         console.error( error );
    //     } );

        var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector: "textarea#abouteditor",
        // height: tinyheight - 23,
        toolbar_drawer: 'sliding',
        menubar: false,
        branding: false,
        //image_dimensions: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime table paste code help wordcount'
        ],
        toolbar: 'undo redo | bold italic underline | link blockquote | bullist numlist outdent indent | removeformat | help',
        relative_urls: false,
        
        setup: function(editor) {
            editor.on('init', function() {
                
            });
        }

    };

    tinymce.init(editor_config);

    $(this).addClass('hidden');
    $('.about.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.occupation.edit').click(function(e) {
    e.preventDefault();
    var occupation = $(this).siblings('input#occupation').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <select class="ui fluid dropdown" name="occupation" value="`+occupation+`">
            <option value="">Career Status</option>
            <option value="Student">Student</option>
            <option value="Employed">Employed</option>
            <option value="Business Owner">Business Owner</option>
        </select>
        <i class="circular inverted occupation undo link icon"></i>
    `);
    $(this).parent().children('select').dropdown('set selected', occupation);
    $(this).addClass('hidden');
    $('.occupation.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.industri.edit').click(function(e) {
    e.preventDefault();
    var industry = $(this).siblings('input#industry').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <select class="ui fluid dropdown" name="industry" value="`+industry+`">
            @include('variables._industry')
        </select>
        <i class="circular inverted industri undo link icon"></i>
    `);
    $(this).parent().children('select').dropdown('set selected', industry);
    $(this).addClass('hidden');
    $('.industri.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.job_desc.edit').click(function(e) {
    e.preventDefault();
    var job_desc = $(this).siblings('input#job_desc').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="job_desc" placeholder="Other Names" value="`+job_desc+`">
        <i class="circular inverted job_desc undo link icon"></i>
    `);
    $(this).addClass('hidden');
    $('.job_desc.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('button[type="submit"]').click(function(e) {
    e.preventDefault();
    $(this).addClass('loading');
    if($('textarea#abouteditor').length) {
        $('textarea#abouteditor').val(tinyMCE.activeEditor.getContent());
    }
    $('.field').find('input,textarea,select').each(function() {
        if($(this).val() == "") {
            $(this).attr('disabled','true');
            
        }
    });
    $('#update_form').submit();
});



///$('button[type="submit"]').click(function(e) {
///    e.preventDefault();
    //$('.field>input').remove();
///    $('.field').find('input,textarea,select').each(function() {
///        if($(this).val() == "") {
///            $(this).attr('disabled','true');
///        }
///    });

    //$('.field').find('textarea')

    // alert('BOY');
///    $('button[type="submit"]').click();
    //$('#update_form').submit();
///});


$('.file-click').click(function() {
    $(this).siblings('input[type="file"]').click();
});


$('.add.book.button').click(function() {
    $('.add.book.modal').modal({
        onApprove : function() {
            //To remove duplicates
            $('input[name="book_title"]').remove();
            $('input[name="book_author"]').remove();
            $('input[name="isbn"]').remove();
            $('textarea[name="book_description"]').remove();
            $('.add.book.button').siblings('.form-group.book').remove();
            //To remove duplicates

            var booktitle = $('input[data-id="book_title"]').val();
            var bookauthor = $('input[data-id="book_author"]').val();
            var isbn = $('input[data-id="isbn"]').val();
            var bookdesc = $('textarea[data-id="book_description"]').val();
            $('.form-group.book').clone().insertAfter('.add.book.button').addClass('hidden').find('input[data-id="book_cover"]').attr('name', 'book_cover');
            $(`
                <input type="text" name="book_title" value="`+booktitle+`" class="hidden">
                <input type="text" name="book_author" value="`+bookauthor+`" class="hidden">
                <input type="text" name="isbn" value="`+isbn+`" class="hidden">
                <textarea name="book_description" class="hidden">`+bookdesc+`</textarea>
            `).insertAfter('.add.book.button');
            
            $('.add.book.button').text('1 Pending');
        },
        onDeny : function() {
            $('input[name="book_title"]').remove();
            $('input[name="book_author"]').remove();
            $('input[name="isbn"]').remove();
            $('textarea[name="book_description"]').remove();
            $('.add.book.button').siblings('.form-group.book').remove();
            $('.add.book.button').text('Add Book');

            $('.add.book.modal').find('input,textarea').val('');
            $('.add.book.modal').find('.remove_bookcover').click();
        }
    }).modal('show');
});


$('.book.info.label').click(function booklabelClick() {
    var bookid = $(this).attr('data-id');
    $('.book.info.modal[data-id="'+bookid+'"]').find('.link,.button').not('.cancel,.close').click(function() {
        $('.book.info.modal[data-id="'+bookid+'"]').find('.approve.button').removeClass('hidden');
        $('.book.info.modal[data-id="'+bookid+'"]').find('.cancel.button').text('Cancel');
    });
    $('.book.info.modal[data-id="'+bookid+'"]').modal({
        onApprove : function() {
            $('.book.info.label[data-id="'+bookid+'"').parent().find('.hidden').remove();
            $('.book.info.label[data-id="'+bookid+'"').parent().append('<input name="book_id" class="hidden" value="'+bookid+'">');
            $(this).find('.content').find('input[name],textarea[name]').not('[type="file"],.cover').clone().appendTo($('.book.info.label[data-id="'+bookid+'"').parent()).addClass('hidden');
            $(this).find('.form-group.bookinfo').clone().appendTo($('.book.info.label[data-id="'+bookid+'"').parent()).addClass('hidden').find('input[data-id="oldbook_cover"]').attr('name', 'oldbook_cover');
            $('.book.info.label[data-id="'+bookid+'"]').find('.icon').removeClass('info').addClass('clock outline');
            $('.book.info.label').not('[data-id="'+bookid+'"]').addClass('disabled').unbind('click', booklabelClick);

        },
        onDeny : function() {
            $('.book.info.label[data-id="'+bookid+'"').parent().find('.hidden').remove();
            $('.book.info.label[data-id="'+bookid+'"]').find('.icon').removeClass('clock outline').addClass('info');
            $('.book.info.label').not('[data-id="'+bookid+'"]').removeClass('disabled').bind('click', booklabelClick);
            $('.book.info.modal[data-id="'+bookid+'"]').find('.undo').click();
            $('.book.info.modal[data-id="'+bookid+'"]').find('.approve.button').addClass('hidden');
            $('.book.info.modal[data-id="'+bookid+'"]').find('.cancel.button').text('Close');
        }
    }).modal('show');

    $('.delete.book.button[data-id="'+bookid+'"]').click(function() {
        $('.delete_book_modal[data-id="'+bookid+'"]').modal({
            onApprove : function() {
                $('.book.info.label').not('[data-id="'+bookid+'"]').addClass('disabled').unbind('click', booklabelClick);
                $('.book.info.label[data-id="'+bookid+'"]').parents('.grid').append(`
                    <input type="text" name="delete_book" id="" value="`+bookid+`" class="hidden">
                `);
                $('.book_thumbnail[data-id="'+bookid+'"]').fadeOut(1000);
            }
        }).modal('show');
    });
});


$('.oldbook_title.edit').click(function(e) {
    e.preventDefault();
    var oldbooktitle = $(this).siblings('input#oldbook_title').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="oldbook_title" placeholder="Book Title" value="`+oldbooktitle+`">
        <i class="circular inverted oldbook_title undo link icon"></i>
    `);
    $(this).addClass('hidden show');
    $('.oldbook_title.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.oldbook_author.edit').click(function(e) {
    e.preventDefault();
    var oldbookauthor = $(this).siblings('input#oldbook_author').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="oldbook_author" placeholder="Author" value="`+oldbookauthor+`">
        <i class="circular inverted oldbook_author undo link icon"></i>
    `);
    $(this).addClass('hidden show');
    $('.oldbook_author.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});

$('.oldisbn.edit').click(function(e) {
    e.preventDefault();
    var oldisbn = $(this).siblings('input#oldisbn').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="oldisbn" placeholder="ISBN" value="`+oldisbn+`">
        <i class="circular inverted oldisbn undo link icon"></i>
    `);
    $(this).addClass('hidden show');
    $('.oldisbn.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.oldbook_description.edit').click(function(e) {
    e.preventDefault();
    var oldbookdesc = $(this).siblings('textarea#oldbook_description').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <textarea name="oldbook_description" placeholder="Short Description of the Book" style="max-height: 25px !important;">`+oldbookdesc+`</textarea>
        <i class="circular inverted oldbook_description undo link icon"></i>
    `);
    $(this).addClass('hidden');
    $('.oldbook_description.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.add.social.button').click(function(e) {
    e.preventDefault();
    $('.add.social.modal').modal({
        autofocus: false,
        onApprove: function() {
            //To remove duplicates
            $('input[name="social_icon"]').remove();
            $('input[name="social_app"]').remove();
            $('input[name="social_id"]').remove();
            $('input[name="social_url"]').remove();
            //To remove duplicates

            var socialapp = $('input[data-id="social_app"]').val();
            var socialid = $('input[data-id="social_id"]').val();
            var socialurl = $('input[data-id="social_url"]').val();
            var socialicon = $('input[data-id="social_url"]').attr('data-icon');
            $(`
                <input type="text" name="social_icon" value="`+socialicon+`" class="hidden">
                <input type="text" name="social_app" value="`+socialapp+`" class="hidden">
                <input type="text" name="social_id" value="`+socialid+`" class="hidden">
                <input type="text" name="social_url" value="`+socialurl+`" class="hidden">
            `).insertAfter('.add.social.button');

            $('.add.social.button').text('1 Pending');
        },
        onDeny: function() {
            $('input[name="social_icon"]').remove();
            $('input[name="social_app"]').remove();
            $('input[name="social_id"]').remove();
            $('input[name="social_url"]').remove();
            $('.add.social.button').text('Add Social Media Account');

            $('.add.social.modal').find('input').val('');
            $('.add.social.modal').find('.social.dropdown').dropdown('clear');
        }
    }).modal('show');
    
    $('.add.social.modal').find('.item').click(function() {
        $('input[data-id="social_id"]').parent().removeClass('disabled');
    });

    $('.item[data-value="Facebook"]').click(function() {
        $('input[data-id="social_url"]').val('facebook.com/').attr('data-icon', 'facebook f');
        $('input[data-id="social_id"]').keyup(function() {
            $('input[data-id="social_url"]').val('facebook.com/' + $(this).val());
        });
    });

    $('.item[data-value="LinkedIn"]').click(function() {
        $('input[data-id="social_url"]').val('linkedin.com/in/').attr('data-icon', 'linkedin in');
        $('input[data-id="social_id"]').keyup(function() {
            $('input[data-id="social_url"]').val('linkedin.com/in/' + $(this).val());
        });
    });

    $('.item[data-value="Twitter"]').click(function() {
        $('input[data-id="social_url"]').val('twitter.com/').attr('data-icon', 'twitter');
        $('input[data-id="social_id"]').keyup(function() {
            $('input[data-id="social_url"]').val('twitter.com/' + $(this).val());
        });
    });

    $('.item[data-value="Pinterest"]').click(function() {
        $('input[data-id="social_url"]').val('pinterest.com/').attr('data-icon', 'pinterest p');
        $('input[data-id="social_id"]').keyup(function() {
            $('input[data-id="social_url"]').val('pinterest.com/' + $(this).val());
        });
    });

    $('.item[data-value="Instagram"]').click(function() {
        $('input[data-id="social_url"]').val('instagram.com/').attr('data-icon', 'instagram');
        $('input[data-id="social_id"]').keyup(function() {
            $('input[data-id="social_url"]').val('instagram.com/' + $(this).val());
        });
    });

    $('.item[data-value="YouTube"]').click(function() {
        $('input[data-id="social_url"]').val('youtube.com/').attr('data-icon', 'youtube');
        $('input[data-id="social_id"]').keyup(function() {
            $('input[data-id="social_url"]').val('youtube.com/' + $(this).val());
        });
    });


    $('.socialurl.link.icon').popup();
    $('.socialurl.link.icon').click(function() {
        var testurl = 'https://' + $('input[data-id="social_url"]').val();
        window.open(testurl, '_blank');
    });
    

});



$('.socialmedia.info.label').click(function socialmedialabelClick() {
    var socialmediaid = $(this).attr('data-id');
    $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.link,.button').not('.cancel,.close').click(function() {
        $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.approve.button').removeClass('hidden');
        $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.cancel.button').text('Cancel');
    });
    $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').modal({
        autofocus: false,
        onApprove : function() {
            $('.socialmedia.info.label[data-id="'+socialmediaid+'"').parent().find('.hidden').remove();
            $('.socialmedia.info.label[data-id="'+socialmediaid+'"').parent().append('<input name="socialmedia_id" class="hidden" value="'+socialmediaid+'">');
            $(this).find('.content').find('input[name]').clone().appendTo($('.socialmedia.info.label[data-id="'+socialmediaid+'"').parent()).addClass('hidden');
            var oldsocialicon = $(this).find('input[data-id="oldsocial_app"]').attr('data-icon');
            if(oldsocialicon == undefined) {
                oldsocialicon = $(this).find('input[id="oldsocial_app"]').attr('data-icon');
            }

            $('.socialmedia.info.label[data-id="'+socialmediaid+'"').parent().append('<input name="oldsocial_icon" class="hidden" value="'+oldsocialicon+'">');
            $('.socialmedia.info.label[data-id="'+socialmediaid+'"]').find('.icon').removeClass('info').addClass('clock outline');
            $('.socialmedia.info.label').not('[data-id="'+socialmediaid+'"]').addClass('disabled').unbind('click', socialmedialabelClick);

        },
        onDeny : function() {
            $('.socialmedia.info.label[data-id="'+socialmediaid+'"').parent().find('.hidden').remove();
            $('.socialmedia.info.label[data-id="'+socialmediaid+'"]').find('.icon').removeClass('clock outline').addClass('info');
            $('.socialmedia.info.label').not('[data-id="'+socialmediaid+'"]').removeClass('disabled').bind('click', socialmedialabelClick);
            $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.undo').click();
            $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.approve.button').addClass('hidden');
            $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.cancel.button').text('Close');
        }
    }).modal('show');

    $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.socialurl.link.icon').popup();
    $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('.socialurl.link.icon').click(function() {
        var oldtesturl = 'https://' + $('.socialmedia.info.modal[data-id="'+socialmediaid+'"]').find('input[name="oldsocial_url"]').val();
        window.open(oldtesturl, '_blank');
    });

    $('.delete.socialmedia.button[data-id="'+socialmediaid+'"]').click(function() {
        $('.delete_socialmedia_modal[data-id="'+socialmediaid+'"]').modal({
            onApprove : function() {
                $('.socialmedia.info.label').not('[data-id="'+socialmediaid+'"]').addClass('disabled').unbind('click', socialmedialabelClick);
                $('.socialmedia.info.label[data-id="'+socialmediaid+'"]').parents('.grid').append(`
                    <input type="text" name="delete_socialmedia" id="" value="`+socialmediaid+`" class="hidden">
                `);
                $('.socialmedia.column[data-id="'+socialmediaid+'"]').fadeOut(1000);
            }
        }).modal('show');
    });
});


$('.oldsocial_app.edit').click(function(e) {
    e.preventDefault();
    var oldsocialapp = $(this).siblings('input#oldsocial_app').val();
    var oldsocialicon = $(this).siblings('input#oldsocial_app').attr('data-icon');
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <div class="ui fluid oldsocial selection dropdown">
            <input type="hidden" data-id="oldsocial_app" name="oldsocial_app" data-icon="`+oldsocialicon+`">
            <i class="dropdown icon"></i>
            <div class="default text">Social Media</div>
            <div class="menu">
                <div class="item" data-value="Facebook" data-text="Facebook">
                    <i class="bordered facebook f icon"></i>
                    Facebook
                </div>
                <div class="item" data-value="LinkedIn" data-text="LinkedIn">
                    <i class="bordered linkedin in icon"></i>
                    LinkedIn
                </div>
                <div class="item" data-value="Twitter" data-text="Twitter">
                    <i class="bordered twitter icon"></i>
                    Twitter
                </div>
                <div class="item" data-value="Pinterest" data-text="Pinterest">
                    <i class="bordered pinterest p icon"></i>
                    Pinterest
                </div>
                <div class="item" data-value="Instagram" data-text="Instagram">
                    <i class="bordered instagram icon"></i>
                    Instagram
                </div>
                <div class="item" data-value="YouTube" data-text="YouTube">
                    <i class="bordered youtube icon"></i>
                    YouTube
                </div>
            </div>
        </div>
        <i class="circular inverted oldsocial_app undo link icon"></i>
    `);
    $(this).parent().find('.dropdown').dropdown('set selected', oldsocialapp);

    $(this).parent().find('.dropdown').find('.item[data-value="Facebook"]').click(function() {
        $(this).parents('.dropdown').find('input[data-id="oldsocial_app"]').attr('data-icon', 'facebook f');
    });
    $(this).parent().find('.dropdown').find('.item[data-value="LinkedIn"]').click(function() {
        $(this).parents('.dropdown').find('input[data-id="oldsocial_app"]').attr('data-icon', 'linkedin in');
    });
    $(this).parent().find('.dropdown').find('.item[data-value="Twitter"]').click(function() {
        $(this).parents('.dropdown').find('input[data-id="oldsocial_app"]').attr('data-icon', 'twitter');
    });
    $(this).parent().find('.dropdown').find('.item[data-value="Pinterest"]').click(function() {
        $(this).parents('.dropdown').find('input[data-id="oldsocial_app"]').attr('data-icon', 'pinterest p');
    });
    $(this).parent().find('.dropdown').find('.item[data-value="Instagram"]').click(function() {
        $(this).parents('.dropdown').find('input[data-id="oldsocial_app"]').attr('data-icon', 'instagram');
    });
    $(this).parent().find('.dropdown').find('.item[data-value="YouTube"]').click(function() {
        $(this).parents('.dropdown').find('input[data-id="oldsocial_app"]').attr('data-icon', 'youtube');
    });

    

    $(this).addClass('hidden show');
    $('.oldsocial_app.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.oldsocial_id.edit').click(function(e) {
    e.preventDefault();
    var oldsocialid = $(this).siblings('input#oldsocial_id').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="oldsocial_id" placeholder="Book Title" value="`+oldsocialid+`">
        <i class="circular inverted oldsocial_id undo link icon"></i>
    `);
    $(this).addClass('hidden show');
    $('.oldsocial_id.undo').click(function() {
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});


$('.oldsocial_url.edit').click(function(e) {
    e.preventDefault();
    var oldsocialurl = $(this).siblings('input#oldsocial_url').val();
    $(this).siblings().addClass('hidden');
    $(this).parent().append(`
        <input type="text" name="oldsocial_url" placeholder="Book Title" value="`+oldsocialurl+`">
        <i class="circular inverted oldsocial_url undo link icon"></i>
    `);
    $(this).addClass('hidden show');
    $(this).parents('.action').find('.icon.button').removeClass('disabled');
    $('.oldsocial_url.undo').click(function() {
        $(this).parents('.action').find('.icon.button').addClass('disabled');
        $(this).siblings().not('.hidden').remove();
        $(this).siblings().removeClass('hidden');
        $(this).remove();
    });
});





$('.remove.readlist.button').click(function(e) {
    e.preventDefault();
    var readlist_id = $(this).attr('data-id');
    $('.remove.readlist.modal[data-id="'+readlist_id+'"]').modal({
        onApprove : function() {
            $(this).find('.approve.button').addClass('disabled loading').siblings().addClass('disabled');
            $('#remove_readlist_form.'+readlist_id).submit();
        return false;
        }
    }).modal('show');
});

@endsection