<div class="ui grid">
    <!-- <div class="ui red row pb-0"> -->
        <div class="ui sixteen wide column">
            <div class="ui inverted basic segment">
                <div class="ui stackable grid">
                    <div class="ui three wide column">
                        <div class="ui inverted tiny secondary menu">
                            <div class="item">
                                <div class="ui large inverted header">
                                    <span class="sidebar_on" data-tooltip="Show Sidebar" data-position="bottom left" data-variation="basic">
                                        <i class="bars link icon"></i>
                                    </span>
                                    <a href="/" class="content text-white">
                                        IABC Africa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="ui ten wide column">
                        <div class="ui inverted compact stackable menu">
                            <a href="/" class="active item home">HOME</a>
                            <div class="ui nav_dropdown dropdown item nav_border_l">
                                ABOUT US
                                <i class="dropdown icon"></i>
                                <div class="ui menu">
                                    <a href="{{ route('about') }}" class="item">About IABC</a>
                                    <a href="{{ route('profiles.author', slug('gospel')) }}" class="item">Meet the Founder</a>
                                    <a class="item">Testimonials</a>
                                </div>
                            </div>
                            <div class="ui nav_dropdown dropdown item nav_border_l">
                                AFRICA'S BUSINESS TODAY
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <a class="item">Africa Business News</a>
                                    <a class="item">Africa’s Enterpreneurs’ Profile</a>
                                    <a class="item">Africa’s SME today</a>
                                </div>
                            </div>
                            <a class="item nav_border_l">BUSINESS PROFILE</a>
                            <a class="item nav_border_l">FORUM</a>
                            <a href="{{ route('contact') }}" class="item nav_border_l cu">CONTACT US</a>
                        </div>
                    </div>
                    <!--  -->
                    <div class="ui three wide right floated column">
                        <div class="ui inverted right floated compact menu social_icon">
                            <div style="display:none;" class="search_input item">
                                <div class="ui icon input">
                                    <input type="text" placeholder="Search...">
                                    <i class="search icon"></i>
                                </div>
                            </div>
                            <a class="ui search icon item" data-tooltip="Search This Website" data-position="bottom left" data-variation="basic">
                                <i class="search icon"></i>
                            </a>
                            @guest
                            <a class="ui icon item account" data-tooltip="Login" data-position="bottom center" data-variation="basic">
                                <i class="user icon"></i>
                            </a>
                            <div id="login_modal" class="ui tiny center aligned modal account">
                                
                                <i class="close icon"></i>
                                <div class="header">
                                    <div class="ui huge centered header">
                                        IABC Africa <br>
                                    </div>
                                    <div class="ui tiny centered header mt-0">
                                        Members get exclusive deals, event invites and more.
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="ui very padded stackable grid">
                                        <div class="ui two column row">
                                            <div class="ui column">
                                                <div class="ui labeled icon fluid blue button login px-0">
                                                    <i class="facebook f icon"></i>
                                                    <span>Login with Facebook</span>
                                                </div>
                                            </div>
                                            <div class="ui column">
                                                <div class="ui labeled icon fluid red button login">
                                                    <i class="google icon"></i>
                                                    <span>Login with Google</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="ui very padded grid">
                                        <div class="ui column">
                                            <form class="ui error form" method="POST" action="{{ route('login') }}">
                                                @csrf
                                                @if(count($errors) > 0)
                                                <div class="ui error message">
                                                    <div class="header">Please check your input</div>
                                                    <ul class="list">
                                                        <li>{{ $errors->first('email') }}</li>
                                                    </ul>
                                                </div>
                                                @endif

                                                <div class="field @error('email') error @enderror">
                                                    <label>Email</label>
                                                    <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email" required>
                                                </div>

                                                <div class="field @error('password') error @enderror ">
                                                    <label>Password</label>
                                                    <input id="password" type="password" name="password" placeholder="Password" required>
                                                </div>

                                                <div class="field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">Remember Me</label>
                                                    </div>
                                                    <a href="{{ route('password.request') }}" class="ui right floated primary tiny header">Forgot Password?</a>
                                                </div>
                                                
                                                <button class="ui orange large fluid button" type="submit">Login</button>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    
                                    <!--  -->
                                    <div class="ui very padded grid">
                                        <div class="ui center aligned column">
                                            <div class="ui text">Don't have an account? &nbsp; <a href="{{ route('register') }}" class="ui tiny primary header"> Sign Up</a> </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            @else
                            <div class="ui inverted icon top left pointing nav_dropdown dropdown link item" data-tooltip="User Account"  data-position="bottom center" data-variation="basic">
                                <i class="user icon"></i>
                                <div class="menu">
                                    <div class="ui fluid message">
                                        <div class="header">
                                            Currently Logged In As:
                                        </div>
                                        <div class="ui large header mt-10">
                                            <img src="@if(!empty(Auth::user()->photo)) {{ asset('img/users/'. Auth::user()->photo) }} @else {{ asset('img/users/head.jpg') }} @endif"  alt="" class="ui avatar image border border-orange">
                                            <div class="content pl-0">
                                                <div class="ui small header">
                                                    {{ Auth::user()->lastname.' '.Auth::user()->firstname[0].'. ' }}
                                                    @if(!empty(Auth::user()->othername))
                                                        {{ Auth::user()->othername[0].'.' }}
                                                    @endif
                                                </div>
                                                @if(Auth::user()->role == 'member')
                                                    @if(!empty(Auth::user()->author))
                                                    <div class="small sub header">{{ ucfirst(Auth::user()->author) }}</div>
                                                    @endif
                                                @else
                                                <div class="small sub header">{{ ucfirst(Auth::user()->role) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ui basic fluid horizontal segments border-0">
                                            <div class="ui center aligned secondary segment border-0 bg-transparent">
                                                <i class="big icons p-rel link">
                                                    <i class="mail icon"></i>
                                                    <div class="ui floating orange circular label">?</div>
                                                </i>
                                            </div>
                                            <div class="ui center aligned secondary segment border-0 bg-transparent">
                                                <i class="big icons p-rel link">
                                                    <i class="chat icon"></i>
                                                    <div class="ui floating orange circular label">?</div>
                                                </i>
                                            </div>
                                            <div class="ui center aligned secondary segment border-0 bg-transparent">
                                                <i class="big icons p-rel link">
                                                    <i class="edit icon"></i>
                                                    <div class="ui floating orange circular label">?</div>
                                                </i>
                                            </div>
                                        </div>
                                        
    
                                        <a href="{{ route('profiles.user', Auth::user()->username) }}" class="ui fluid basic orange button mt-10">My Profile</a>
                                        @if(!empty(Auth::user()->author))
                                            @if(Auth::user()->author == 'Editor')
                                            <a href="{{ route('articles.index') }}" class="ui fluid basic orange button mt-10">Manage Articles</a>
                                            @else
                                            <a href="{{ route('articles.create') }}" class="ui fluid basic orange button mt-10">Write An Article</a>
                                            @endif
                                        @endif
                                        <div class="ui fluid red button mt-10 logout_button">Logout</div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                                
                                    </div>
                                </div>
                            </div>
                            
                            @endguest
                            <a href="https://web.facebook.com/IABCAfrica" class="ui icon item" data-tooltip="Like Us on Facebook" data-position="bottom center" data-variation="basic">
                                <i class="facebook f icon"></i>
                            </a>
                            <a href="https://twitter.com/IABC_Africa" class="ui icon item" data-tooltip="Follow Us on Twitter" data-position="bottom right" data-variation="basic">
                                <i class="twitter icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    <!-- </div> -->
</div>


@section('custom_script')



    

@endsection








