@extends('templates.master')

@section('title', 'IABC Africa - Home')

@section('content')

<div class="ui grid">
    <div class="ui sixteen wide column">
        <div class="ui fluid image">
            <img src="{{asset('img/bg/banner-business-solutions-1200x300.jpg')}}" alt="">
        </div>
    </div>
</div>

<div class="ui container mt-20">
    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui large header">
                MOST RECENT POSTS
                <i class="right blue arrow icon"></i>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="eight wide column">
                    <div class="ui fluid card">
                        <div class="ui image">
                            <img src="{{ asset('img/articles/' . sprintf('%06d', $mostrecentarticles[0]->id) . '-' . slug($mostrecentarticles[0]->title) . '/featured/' . $mostrecentarticles[0]->image) }}">
                        </div>
                        <div class="content">
                            <a href="{{ route('topic.articles', slug($mostrecentarticles[0]->topic->name)) }}" class="ui small blue text uppercase">{{ $mostrecentarticles[0]->topic->name }}</a>
                            <a href="{{ route('articles.read', slug($mostrecentarticles[0]->title)) }}">
                                <div class="ui large header mt-0">{{ titleCase($mostrecentarticles[0]->title) }}</div>
                            </a>
                            <div class="ui inverted text">
                                <span>{{ $mostrecentarticles[0]->description }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eight wide column">
                    @php
                        $i = 1;
                        $count = 0;
                    @endphp
                    @foreach($mostrecentarticles as $article)
                        @php if($count == 4)
                            break;
                        @endphp
                        
                        @if($i > 1)
                        <div class="ui fluid y_card horizontal card">
                            <div class="ui fluid image" style="background-color: red;">
                                <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}" class="ui image image-fit">
                            </div>
                            <div class="fluid content">
                                <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui small blue text uppercase">{{ $article->topic->name }}</a>
                                <a href="{{ route('articles.read', slug($article->title)) }}">
                                    <div class="ui header mt-0">{{ $article->title }}</div>
                                </a>
                                <div class="ui inverted text">
                                    {{ $article->description }}
                                </div>
                            </div>
                        </div>
                        @endif
                        @php
                            $i++;
                            $count++
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ui centered four wide computer ten wide mobile column">
            <a href="{{ route('articles.latest') }}" class="ui large fluid orange button">More from Latest</a>
        </div>
    </div>

    <!--  -->

    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>

    <div class="ui grid">
        <div class="sixteen wide column">

            <!--  -->
            <div class="ui stackable grid">
                <div class="ui row">
                    <!--  -->
                    <div class="ten wide column">
                        <div class="ui large header">
                            MOST POPULAR
                        </div>
                        <div class="ui divider"></div>

                        <div class="ui divided divided stackable relaxed items">
                            @php $count = 0; @endphp @foreach($mostpopulararticles as $article) @php if($count == 3) break; @endphp
                            <div class="item">
                                <div class="ui small image">
                                    <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}" class="ui image image-fit">
                                </div>
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui small blue text uppercase">{{ $article->topic->name }}</a>
                                    <a href="{{ route('articles.read', slug($article->title)) }}">
                                        <div class="ui header mt-5">{{ titleCase($article->title) }}</div>
                                    </a>
                                    <div class="ui text mt-10">
                                        {{ $article->description }}
                                    </div>
                                </div>
                            </div>
                            @php $count++ @endphp @endforeach
                        </div>

                        <div class="ui grid">
                            <div class="ui centered four wide computer ten wide mobile column">
                                <a href="{{ route('articles.popular') }}" class="ui large fluid orange button">View More</a>
                            </div>
                        </div>

                    </div>
                    <!--  -->
                    <div class="six wide column">
                        <div class="ui very padded placeholder segment">
                            <div class="ui icon header">
                                <i class="ad icon"></i> Show your Products and Services to Our ? million viewers
                            </div>
                            <div class="ui primary button">Place Ad Here</div>
                            <div class="ui tiny statistic green">
                                <div class="value">
                                    1,000,000
                                </div>
                                <div class="label">
                                    Registered Users
                                </div>
                                <div class="value mt-10">
                                    2,500
                                </div>
                                <div class="label">
                                    Daily Visits
                                </div>
                            </div>
                            <div class="ui tiny center aligned header pt-0">
                                <a class="ui blue center alinged text">* Terms and Conditions</a> Apply
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>

    <div class="ui grid">
        <div class="sixteen wide column">
            <div class="ui large header">
                NEWS & TRENDS
                <i class="right blue arrow icon"></i>
            </div>
            <div class="ui divider"></div>
            <div class="ui three stackable cards">
                @php $vals = range(1, $articlecount); shuffle($vals); $count = 0; @endphp @foreach($vals as $val) @php if($count == 3) break; @endphp
                <div class="ui card">
                    <div class="ui image">
                        <img src="{{ asset('img/articles/' . sprintf('%06d', $articles[$val]->id) . '-' . slug($articles[$val]->title) . '/featured/' . $articles[$val]->image) }}" alt="">
                    </div>
                    <div class="content">
                        <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                        <a href="{{ route('articles.read', slug($articles[$val]->title)) }}">
                            <div class="ui large header mt-0">{{ titleCase($articles[$val]->title) }}</div>
                        </a>
                        <div class="ui text">
                            {{ $articles[$val]->description }}
                        </div>
                    </div>
                    <div class="content py-0">
                        <div class="ui basic horizontal segments">
                            <div class="ui vertically fitted segment">
                                <i class="user icon"></i>
                                <a href="{{ route('profiles.author', slug($articles[$val]->user->username)) }}">
                                {{ $articles[$val]->user->lastname.' '.$articles[$val]->user->firstname[0].'.' }}
                            </a>
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="clock icon"></i> {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="book reader icon"></i> {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                            </div>
                        </div>
                    </div>
                </div>
                @php $count++ @endphp @endforeach
                <!--  -->

            </div>
        </div>
    </div>

    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>
    <!--  -->

    <!--  -->
    <div class="ui stackable grid">
        <div class="two column row">
            <div class="column mt-20">
                <div class="ui large header">
                    STARTING A BUSINESS
                </div>
                <div class="ui divider"></div>
                <div class="ui divided stackable relaxed items">
                    @php
                        $count = 0;
                    @endphp
                    @foreach($articles as $article)
                        @if($article->topic->id == 9)
                            @php
                                if($count == 3) break;
                            @endphp
                            <div class="item">
                                <div class="ui small image">
                                    <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}" class="ui fluid image">
                                </div>
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui small blue text uppercase d-block">{{ $article->topic->name }}</a>
                                    <a href="{{ route('articles.read', slug($article->title)) }}">
                                        <div class="ui large header mt-0">{{ titleCase($article->title) }}</div>
                                    </a>
                                    <div class="ui text">
                                        {{ $article->description }}
                                    </div>
                                </div>
                            </div>
                            @php
                                $count++
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>
            <!--  -->
            <div class="column mt-20">
                <div class="ui large header">
                    INSPIRATION
                </div>
                <div class="ui divider"></div>
                <div class="ui divided stackable relaxed items">
                    @php
                        $count = 0;
                    @endphp
                    @foreach($articles as $article)
                        @if($article->topic->id == 1)
                            @php
                                if($count == 3) break;
                            @endphp
                            <div class="item">
                                <div class="ui small image">
                                    <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}" class="ui fluid image">
                                </div>
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui small blue text uppercase d-block">{{ $article->topic->name }}</a>
                                    <div class="ui large header mt-0">{{ titleCase($article->title) }}</div>
                                    <div class="ui text">
                                        {{ $article->description }}
                                    </div>
                                </div>
                            </div>
                            @php
                                $count++
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--  -->

    <!--  -->
    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>

    <div class="ui grid">
        <div class="sixteen wide column">
            <div class="ui large header">
                DAILY MOTIVATION
                <i class="right blue arrow icon"></i>
            </div>
            <div class="ui divider"></div>
            <div class="ui three stackable cards">
                @php
                    $vals = range(1, $articlecount);
                    shuffle($vals);
                    $count = 0;
                @endphp
                
                @foreach($vals as $val)
                    @php if($count == 3) break;
                @endphp
                <div class="ui card">
                    <div class="ui image">
                        <img src="{{ asset('img/articles/' . sprintf('%06d', $articles[$val]->id) . '-' . slug($articles[$val]->title) . '/featured/' . $articles[$val]->image) }}" alt="">
                    </div>
                    <div class="content">
                        <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                        <a href="{{ route('articles.read', $articles[$val]->id) }}">
                            <div class="ui large header mt-5">{{ $articles[$val]->title }}</div>
                        </a>
                        <div class="ui text mt-10">
                            {{ $articles[$val]->description }}
                        </div>
                    </div>
                    <div class="content py-0">
                        <div class="ui basic horizontal segments">
                            <div class="ui vertically fitted segment">
                                <i class="user icon"></i>
                                <a href="{{ route('profiles.author', slug($articles[$val]->user->username)) }}">
                                    {{ $articles[$val]->user->lastname.' '.$articles[$val]->user->firstname[0].'.' }}
                                </a>
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="clock icon"></i> {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="book reader icon"></i> {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $count++
                @endphp
                
                @endforeach
                <!--  -->
            </div>
        </div>
    </div>
    <!--  -->

    <!--  -->
    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>
    <!--  -->

    <!--  -->
    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui large header">
                YOUNGEST BUSINESS TYCOONS
                <i class="right blue arrow icon"></i>
            </div>
            <div class="ui divider"></div>
            <!--  -->
            <div class="ui stackable grid">
                <div class="ui two column row">
                    <div class="eight wide computer sixteen wide mobile column">
                        @php $val = rand(1, $articlecount) @endphp
                        <div class="ui fluid card">
                            <div class="ui image">
                                <img src="{{ asset('img/articles/' . sprintf('%06d', $articles[$val]->id) . '-' . slug($articles[$val]->title) . '/featured/' . $articles[$val]->image) }}" alt="">
                            </div>
                            <div class="content">
                                <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                <a href="{{ route('articles.read', slug($articles[$val]->title)) }}">
                                    <div class="ui large header mt-5">{{ $articles[$val]->title }}</div>
                                </a>
                                <div class="ui text">
                                    {{ $articles[$val]->description }}
                                </div>
                            </div>
                            <div class="content py-0">
                                <div class="ui basic horizontal segments">
                                    <div class="ui vertically fitted segment">
                                        <i class="user icon"></i>
                                        <a href="{{ route('profiles.author', slug($articles[$val]->user->username)) }}">
                                        {{ $articles[$val]->user->lastname.' '.$articles[$val]->user->firstname[0].'.' }}
                                    </a>
                                    </div>
                                    <div class="ui vertically fitted segment">
                                        <i class="clock icon"></i> {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                                    </div>
                                    <div class="ui vertically fitted segment">
                                        <i class="book reader icon"></i> {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="eight wide computer only column">
                        @php $vals = range(1, $articlecount); shuffle($vals); $count = 0; @endphp @foreach($vals as $val) @php if($count == 3) break; @endphp
                        <div class="ui fluid horizontal card">
                            <div class="content">
                                <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                <a href="{{ route('articles.read', slug($articles[$val]->title)) }}">
                                    <div class="ui large header mt-0">{{ $articles[$val]->title }}</div>
                                </a>
                                <div class="ui text">
                                    {{ $articles[$val]->description }}
                                </div>
                            </div>
                            <div class="ui fluid right floated image">
                                <img src="{{ asset('img/articles/' . sprintf('%06d', $articles[$val]->id) . '-' . slug($articles[$val]->title) . '/featured/' . $articles[$val]->image) }}" class="ui image image-fit">
                            </div>
                        </div>
                        @php $count++ @endphp @endforeach
                        <!--  -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  -->

    <!--  -->
    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>
    <!--  -->



    <!--  -->
    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui large header">
                FEATURED CONTRIBUTORS
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="three column row">
                    <div class="column">
                        <div class="ui very padded center aligned secondary segment">
                            <div class="ui small circular image">
                                <img src="{{asset('img/people/gospel.jpg')}}" alt="">
                            </div>
                            <div class="ui header">Gospel Obi</div>
                            <div class="ui text">Writer, Consultant, Lifetime Entrepreneur</div>
                            <div class="ui orange button mt-10">Follow</div>
                            <div class="ui divider"></div>
                            <div class="ui text text-left">TOP STORY</div>
                            <div class="ui left aligned small header mt-0">Top Seven Car Manufacturing Companies in Africa</div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('custom_script')

    $('.article_body').find('img').remove();

@endsection

@section('custom_window_width_script')

    $('.y_card').removeClass('horizontal');

@endsection

@section('custom_resize_if_script')

    $('.y_card').addClass('horizontal');

@endsection

@section('custom_resize_else_script')

    $('.y_card').removeClass('horizontal');

@endsection