@extends('templates.master')

@section('content')

    <section class="ui container">
        
        <div class="ui grid">
            <div class="ui eight wide computer sixteen wide mobile centered column">
                <div class="ui raised segments">
                    <div class="ui center aligned raised segment">
                        <div class="ui large header mb-0">Reset Password</div>
                    </div>
                    <div class="ui raised segment">
                        <div class="ui very padded grid">
                            <div class="ui column">
                                <form class="ui error form" method="POST" action="{{ route('password.update') }}">
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

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="field @error('email') error @enderror">
                                        <label>Email Address</label>
                                        <input id="email" type="email" name="email" placeholder="Enter valid email address" value="{{ $email ?? old('email') }}" autocomplete="email" required autofocus>
                                    </div>
                                    <div class="field @error('password') error @enderror">
                                        <label>Password</label>
                                        <input id="password" type="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="field">
                                        <label>Confirm Password</label>
                                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Password" autocomplete="new-password" required>
                                    </div>

                                    <button class="ui orange large fluid button" type="submit">Reset Password</button>
                                </form>
                                
                            </div>
                            
                        </div>
                        <!--  -->
                    </div>
                </div>
                
            </div>
        </div>
        <!--  -->
        <!--  -->


    </section>

@endsection