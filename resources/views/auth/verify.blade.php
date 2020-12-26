@extends('templates.master')

@section('content')

    <section class="ui container">
        
        <div class="ui grid">
            <div class="ui eight wide computer sixteen wide mobile centered column">
                <div class="ui raised segments">
                    <div class="ui center aligned raised segment">
                        <div class="ui large header mb-0">Verify Your Email Address</div>
                    </div>
                    <div class="ui raised segment">
                        <div class="ui very padded grid">
                            <div class="ui column">
                                @if (session('resent'))
                                <div class="ui success message">
                                    <div class="header">
                                        A fresh verification link has been sent to your email address.
                                    </div>
                                </div>
                                @endif
                                <div class="ui text mt-10">
                                    Before proceeding, please check your email for a verification link.
                                    If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.
                                </div>
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
        <!--  -->
    </section>

@endsection