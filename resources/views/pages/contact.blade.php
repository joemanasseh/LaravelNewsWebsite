@extends('templates.master')

@section('title', 'IABC Africa - Contact Us')

@section('content')


<section class="ui grid mt45">
    <div class="sixteen wide column">
        <div class="ui basic segment">
            <div class="ui huge centered article header">
                We Love to Hear From You
                <div class="sub header">
                Contact Us Via Any of the Following Channels
                </div>
            </div>
            <br><br>
            <div class="ui container">
                <div class="ui stackable two column grid">
                    <div class="ui column">
                        <div class="ui huge very relaxed list">
                            <div class="item">
                                <i class="circlular map marker alternate icon"></i>
                                <div class="content">
                                    <div class="header">IABC Africa Place</div>
                                    <div class="description">
                                        44B, Ilotchuonwu Street, <br>
                                        Otolo, Nnewi, <br>
                                        Anambra State, <br>
                                        Nigeria. <br>
                                        (435101)
                                    </div>
                                </div>
                            </div>
                            <a href="sms:+2348030723126" class="item">
                                <i class="comment alternate icon"></i>
                                <div class="middle aligned content">
                                    <div class="description">+234 803 072 3126</div>
                                </div>
                            </a>
                            <a href="tel:+2348030723126" class="item">
                                <i class="phone icon"></i>
                                <div class="middle aligned content">
                                    <div class="description">+234 803 072 3126</div>
                                </div>
                            </a>
                            <a href="https://wa.me/2348030723126" class="item">
                                <i class="whatsapp icon"></i>
                                <div class="middle aligned content">
                                    <div class="description">+234 803 072 3126</div>
                                </div>
                            </a>
                            <div class="item">
                                <a href="https://web.facebook.com/IABCAfrica"><i class="bordered inverted large facebook f link icon"></i></a>
                                <a href="https://twitter.com/IABC_Africa"><i class="bordered inverted large twitter link icon"></i></a>
                                <a href="https://www.instagram.com/officialiabcafrica/"><i class="bordered inverted large instagram link icon"></i></a>
                                <a href="https://www.linkedin.com/company/officialiabcafrica"><i class="bordered inverted large linkedin in link icon"></i></a>
                                <a href="https://www.pinterest.com/IABCAfrica/"><i class="bordered inverted large pinterest p link icon"></i></a>
                                <a href="https://www.youtube.com/channel/UCxamT2iw6gldNozryxAfmmw"><i class="bordered inverted large youtube link icon"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="ui column">
                        <div class="ui raised orange segment">
                            <div class="ui large dividing header">Write to Us</div>
                            <form class="ui form" method="POST" action="{{ route('contactmail') }}">
                                @csrf
                                <div class="ui two fields">
                                    <div class="field @if ($errors->has('name')) error @endif">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Name">
                                    </div>

                                    <div class="field @if ($errors->has('subject')) error @endif">
                                        <label for="">Subject</label>
                                        <select name="subject" id="" class="ui dropdown">
                                            <option value="Inquiry">Inquiry</option>
                                            <option value="Feedback">Feedback</option>
                                            <option value="Complaint">Complaint</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="field @if ($errors->has('email')) error @endif">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                                
                                <div class="field @if ($errors->has('body')) error @endif">
                                    <label>Message</label>
                                    <textarea name="message" rows="3">{{ old('message') }}</textarea>
                                </div>
                                
                                <button type="submit" class="ui fluid orange button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>


@endsection

@section('custom_script')

    $('.content_wrap').find('.link.icon').hover(
        function() {
            $(this).addClass('orange inverted')
        },
        function() {
            $(this).removeClass('orange inverted')
        }
    );

@endsection

@section('custom_window_width_script')

    $('.content_wrap').addClass('text-center');
    $('.newsletter, .description').addClass('mt-20');

@endsection

@section('custom_resize_if_script')

    $('.content_wrap').removeClass('text-center');
    $('.newsletter, .description').removeClass('mt-20');

@endsection

@section('custom_resize_else_script')

    $('.content_wrap').addClass('text-center');
    $('.newsletter, .description').addClass('mt-20');

@endsection

