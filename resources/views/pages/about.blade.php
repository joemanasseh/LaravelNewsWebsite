@extends('templates.master')

@section('title', 'IABC Africa - About Us')

@section('content')

<div class="mt45"></div>

<section class="ui grid">
    <div class="ui row p-20">
        <div class="sixteen wide column">
            <div class="ui container">
                <div class="ui grid">
                    <div class="ui fourteen wide centered column">
                        <div class="ui items">
                            <div class="ui item">
                                <div class="ui medium image">
                                    <img src="{{ asset('img/logo/favicon.png') }}">
                                </div>
                                <div class="middle aligned content">
                                    <div class="content_wrap">
                                        <div class="ui huge header">INITIATING AFRICA BUSINESS CONCEPT</div>
                                        <div class="description fs-1-5 mt-50">
                                            Get in Touch Via:
                                        </div>
                                        <div class="mt-20">
                                            <a href="https://web.facebook.com/IABCAfrica"><i class="large circular facebook f link icon"></i></a>
                                            <a href="https://www.linkedin.com/company/officialiabcafrica"><i class="large circular linkedin in link icon"></i></a>
                                            <a href="https://twitter.com/IABC_Africa"><i class="large circular twitter link icon"></i></a>
                                            <a href="https://www.pinterest.com/IABCAfrica/"><i class="large circular pinterest link icon"></i></a>
                                            <a href="https://www.instagram.com/officialiabcafrica/"><i class="large circular instagram link icon"></i></a>
                                            <a href="https://www.youtube.com/channel/UCxamT2iw6gldNozryxAfmmw"><i class="large circular youtube link icon"></i></a>
                                            <a href=""><i class="large circular envelope link icon"></i></a>
                                            <a href="https://iabcafrica.com"><i class="large circular globe link icon"></i></a>
                                            <!-- <i class="large circular rss link icon"></i> -->
                                            <i class="icon"></i>
                                            <button class="ui orange button newsletter">Newsletter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                
            </div>
        </div>
    </div>
</section>

<section class="ui container">
    <div class="ui stackable grid mt-50">
        <div class="ui sixteen wide column">
            <div class="ui huge header">About IABC Africa</div>
            <div class="ui fluid raised card">
                <div class="content p-20">
                    <div class="description fs-1-5 text-justify">
                        <p class="article">
                            Initiating Africa Business Concept (IABC) International, commonly known as IABC Africa,  is a youth-oriented pan- African entrepreneurial research organization centered on unveiling the principles and practice involved in setting-up, sustaining and administering Small, Medium and Large-Scales African businesses across the globe. <br><br>
                            <a href="https://iabcafrica.com">IABCAfrica.com</a> provides real time managerial tips, practical steps to business growth, time management tips, marketing and revenue strategies and also shares stories of local entrepreneurs making waves across the continent and beyond alongside trending business news. <br><br>
                            We provide an online platform where African entrepreneurs, founders, business thought leaders, innovators and influencers can share new ideas and offer strategic insights and how-to guidance for the people that make things happen. At IABC Africa we create experiences, share knowledge and build connections across all media channels. <br><br>
                            As a growing name in entrepreneurial journalism, IABC Africa guides founders, innovators and influencers that are shaping our world–to propel their businesses forward. <br><br>
                            <a href="https://iabcafrica.com">IABCAfrica.com</a> intends to fuel the spectrum of game-changers that define what it means to be an entrepreneur in the African soil today. <br><br>
                            <a href="">The IABC Africa Verified Business Profile</a> is the perfect tool for helping entrepreneurs and small companies showcase their companies in self-developed attention-grabbing context while the <a href="">IABC Africa Business Forum</a> provides avenue for business starters, business thought Leaders, founders, innovators, and influencers to share knowledge, create experiences and build connections that last. <br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui four wide column"></div>
    </div>
    <!--  -->
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

