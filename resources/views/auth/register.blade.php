@extends('templates.master')

@section('content')

    <section class="ui container">
        
        <div class="ui grid">
            <div class="ui eight wide computer sixteen wide mobile centered column">
                <div class="ui raised segments">
                    <div class="ui center aligned raised segment">
                        <div class="ui huge header mb-0">IABC Africa</div>
                        <div class="ui text">Create an account to gain access to member exclusive bonuses</div>
                    </div>
                    <div class="ui raised segment">
                        <div class="ui very padded stackable grid">
                            <div class="ui two column row">
                                <div class="ui column">
                                    <div class="ui labeled icon fluid blue button login">
                                        <i class="facebook f icon"></i>
                                        <span>Signup with Facebook</span>
                                    </div>
                                </div>
                                <div class="ui column">
                                    <div class="ui labeled icon fluid red button login">
                                        <i class="google icon"></i>
                                        <span>Signup with Google</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="ui very padded grid">
                            <div class="ui column">
                                <form class="ui error form" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    @if(count($errors) > 0)
                                    <div class="ui error message">
                                        <div class="header">Please check your input</div>
                                        <ul class="list">
                                            @foreach($errors->all() as $input_error)
                                            <li>{{ $input_error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="two fields">
                                        <div class="field @error('lastname') error @enderror">
                                            <label class="ui small header">Last Name</label>
                                            <input id="lastname" type="text" name="lastname" placeholder="Last Name / Surname" value="{{ old('lastname') }}" autocomplete="lastname" required>
                                        </div>
                                        <div class="field @error('firstname') error @enderror">
                                            <label class="ui small header">First Name</label>
                                            <input id="firstname" type="text" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" autocomplete="firstname" required>
                                        </div>
                                    </div>
                                    <div class="hidden field @error('username') error @enderror">
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

                                    <button class="ui orange large fluid button" type="submit">Create Account</button>
                                </form>
                                
                            </div>
                            
                        </div>
                        <!--  -->
                        <div class="ui very padded grid">
                            <div class="ui center aligned column">
                                <div class="ui text">Already have an account? &nbsp; <a href="{{ route('login') }}" class="ui tiny primary header"> Login</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!--  -->
        <!--  -->


    </section>

@endsection

@section('custom_script')

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
    var username = (lastname+'_'+firstname+'_'+time).replace(/ /g,'_');
    $('input#username').val(username);
    
});

@endsection