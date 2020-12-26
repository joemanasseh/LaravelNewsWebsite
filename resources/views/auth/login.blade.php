@extends('templates.master')

@section('content')

    <section class="ui container">
        
        <div class="ui grid">
            <div class="ui eight wide computer sixteen wide mobile centered column">
                <div class="ui raised segments">
                    <div class="ui center aligned raised segment">
                        <div class="ui huge header mb-0">IABC Africa</div>
                        <div class="ui text">Login into your account to gain access to member exclusive bonuses</div>
                    </div>
                    <div class="ui raised segment">
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
                                    <div class="field">
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
                
            </div>
        </div>
        <!--  -->
        
    </section>

@endsection

@section('custom_script')

    $('form').submit(function() {
        $('.button[type="submit"]').addClass('loading');
    });
    

@endsection