@extends('templates.master')

@section('title', 'IABC Africa - Home')

@section('content')



<div class="ui grid">
    <div class="ui sixteen wide column">
        <div class="ui fluid image">
            <img src="{{asset('img/bg/banner-business-solutions-1200x300.jpg')}}" alt="">
        </div>
    </div>
    <!--  -->
    
</div>

<div class="ui container mt-20">
    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui large header">   
                MOST RECENT POSTS
                <i class="right blue arrow icon"></i>
            </div>
            <div class="ui divider"></div>
            <!--  -->
            <div class="ui stackable grid">
                <div class="ui two column row">
                    <div class="eight wide computer sixteen wide mobile column">
                        @php
                            $val = rand(1, $articlecount)
                        @endphp
                        <div class="ui fluid card">
                            <div class="ui image">
                                <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" alt="">
                            </div>
                            <div class="content">
                                <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                <a href="{{ route('articles.read', $articles[$val]->id) }}">
                                    <div class="ui large header mt-0">{{ $articles[$val]->title }}</div>
                                </a>
                                <div class="ui text">
                                    {!! str_limit($articles[$val]->body, $limit = 200, $end = '...') !!}
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
                                        <i class="clock icon"></i>
                                        {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                                    </div>
                                    <div class="ui vertically fitted segment">
                                        <i class="book reader icon"></i>
                                        {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="eight wide column">
                        @php
                            $vals = range(1, $articlecount);
                            shuffle($vals);
                            $count = 0;
                        @endphp
                        @foreach($vals as $val)
                        @php
                            if($count == 4) break;
                        @endphp
                        <div class="ui fluid y_card horizontal card">
                            <div class="ui fluid image" style="background-color: red;">
                                <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" class="ui image image-fit">
                            </div>
                            <div class="fluid content">
                                <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                <a href="{{ route('articles.read', $articles[$val]->id) }}">
                                    <div class="ui header mt-0">{{ $articles[$val]->title }}</div>
                                </a>
                                <div class="ui text">
                                    {{ $articles[$val]->description }}
                                </div>
                            </div>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
        <div class="ui centered four wide computer ten wide mobile column">
            <div class="ui large fluid orange button">More from Latest</div>
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
                            @php
                                $vals = range(1, $articlecount);
                                shuffle($vals);
                                $count = 0;
                            @endphp
                            @foreach($vals as $val)
                            @php
                                if($count == 3) break;
                            @endphp
                            <div class="item">
                                <div class="ui small image">
                                    <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" class="ui image image-fit">
                                </div>
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                    <a href="{{ route('articles.read', $articles[$val]->id) }}">
                                        <div class="ui header mt-5">{{ $articles[$val]->title }}</div>
                                    </a>
                                    <div class="ui text mt-10">
                                        {{ $articles[$val]->description }}
                                    </div>
                                </div>
                            </div>
                            @php $count++ @endphp
                            @endforeach
                            <!-- <div class="item">
                                <div class="ui fluid small image">
                                    <img src="{{ asset('img/articles/' . $articles[rand(1,$articlecount)]->image) }}" class="ui fluid image">
                                </div>
                                <div class="content">
                                    <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase d-block">{{ $articles[rand(1,$articlecount)]->topic->name }}</a>
                                    <a href="{{ route('articles.read', $articles[rand(1,$articlecount)]->id) }}">
                                        <div class="ui header mt-5">{{ $articles[rand(1,$articlecount)]->title }}</div>
                                    </a>
                                    <div class="ui text mt-10">
                                        {{ $articles[rand(1,$articlecount)]->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ui fluid small image">
                                    <img src="{{ asset('img/articles/' . $articles[rand(1,$articlecount)]->image) }}" class="ui fluid image">
                                </div>
                                <div class="content">
                                    <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase d-block">{{ $articles[rand(1,$articlecount)]->topic->name }}</a>
                                    <a href="{{ route('articles.read', $articles[rand(1,$articlecount)]->id) }}">
                                        <div class="ui header mt-5">{{ $articles[rand(1,$articlecount)]->title }}</div>
                                    </a>
                                    <div class="ui text mt-10">
                                        {{ $articles[rand(1,$articlecount)]->description }}
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        
                        <div class="ui grid">
                            <div class="ui centered four wide computer ten wide mobile column">
                                <div class="ui large fluid orange button">View More</div>
                            </div>
                        </div>
                        
                    </div>
                    <!--  -->
                    <div class="six wide column">
                        <div class="ui very padded placeholder segment">
                            <div class="ui icon header">
                                <i class="ad icon"></i>
                                Show your Products and Services to Our ? million viewers
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
                                <a href="{{ route('errors.cs') }}" class="ui blue center alinged text">* Terms and Conditions</a> Apply
                            </div>
                        </div>
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
        <div class="sixteen wide column">
            <div class="ui large header">   
                NEWS & TRENDS
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
                @php
                    if($count == 3) break;
                @endphp
                <div class="ui card">
                    <div class="ui image">
                        <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" alt="">
                    </div>
                    <div class="content">
                        <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                        <a href="{{ route('articles.read', $articles[$val]->id) }}">
                            <div class="ui large header mt-0">{{ $articles[$val]->title }}</div> 
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
                                <i class="clock icon"></i>
                                {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="book reader icon"></i>
                                {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                            </div>
                        </div>
                    </div>
                </div>
                @php $count++ @endphp
                @endforeach
                <!--  -->
                <!-- <div class="ui card">
                    <div class="ui image">
                        <img src="{{ asset('img/articles/' . $articles[9]->image) }}" alt="">
                    </div>
                    <div class="content">
                        <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase">{{ $articles[9]->topic->name }}</a>
                        <a href="{{ route('articles.read', $articles[9]->id) }}">
                            <div class="ui large header mt-0">{{ $articles[9]->title }}</div>
                        </a>
                        <div class="ui text">
                        {{ $articles[9]->description }} 
                        </div>
                    </div>
                    <div class="content py-0">
                        <div class="ui basic horizontal segments">
                            <div class="ui vertically fitted segment">
                                <i class="user icon"></i>
                                <a href="{{ route('profiles.author', slug($articles[9]->user->username)) }}">
                                    {{ $articles[9]->user->lastname.' '.$articles[9]->user->firstname[0].'.' }}
                                </a>
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="clock icon"></i>
                                {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="book reader icon"></i>
                                {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--  -->
                <!-- <div class="ui card">
                    <div class="ui image">
                        <img src="{{ asset('img/articles/' . $articles[10]->image) }}" alt="">
                    </div>
                    <div class="content">
                        <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase">{{ $articles[10]->topic->name }}</a>
                        <a href="{{ route('articles.read', $articles[10]->id) }}">
                            <div class="ui large header mt-0">{{ $articles[10]->title }}</div>
                        </a>
                        <div class="ui text">
                            {{ $articles[10]->description }} 
                        </div>
                    </div> 
                    <div class="ui content py-0">
                        <div class="ui basic horizontal bottom attached segments">
                            <div class="ui vertically fitted segment">
                                <i class="user icon"></i>
                                <a href="{{ route('profiles.author', slug($articles[10]->user->username)) }}">
                                    {{ $articles[10]->user->lastname.' '.$articles[10]->user->firstname[0].'.' }}
                                </a>
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="clock icon"></i>
                                {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="book reader icon"></i>
                                {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                            </div>
                        </div>
                    </div>
                </div> -->
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
    <div class="ui stackable grid">
        <div class="two column row">
            <div class="column mt-20">
                <div class="ui large header">   
                    TECHNOLOGY
                </div>
                <div class="ui divider"></div>
                <div class="ui divided stackable relaxed items">
                    @php
                        $vals = range(1, $articlecount);
                        shuffle($vals);
                        $count = 0;
                    @endphp
                    @foreach($vals as $val)
                    @php
                        if($count == 3) break;
                    @endphp
                    <div class="item">
                        <div class="ui small image">
                            <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" class="ui fluid image">
                        </div>
                        <div class="content">
                            <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase d-block">{{ $articles[$val]->topic->name }}</a>
                            <a href="{{ route('articles.read', $articles[$val]->id) }}">
                                <div class="ui large header mt-0">{{ $articles[$val]->title }}</div>
                            </a>
                            <div class="ui text">
                            {{ $articles[$val]->description }} 
                            </div>
                        </div>
                    </div>
                    @php $count++ @endphp
                    @endforeach
                    <!-- <div class="item">
                        <div class="ui small image">
                            <img src="{{ asset('img/articles/' . $articles[rand(1,$articlecount)]->image) }}" class="ui sfluid image">
                        </div>
                        <div class="content">
                            <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase d-block">{{ $articles[rand(1,$articlecount)]->topic->name }}</a>
                            <div class="ui large header mt-0">{{ $articles[rand(1,$articlecount)]->title }}</div>
                            <div class="ui text">
                            {{ $articles[rand(1,$articlecount)]->description }} 
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="item">
                        <div class="ui small image">
                            <img src="{{ asset('img/articles/' . $articles[rand(1,$articlecount)]->image) }}" class="ui fluid image">
                        </div>
                        <div class="content">
                            <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase d-block">{{ $articles[rand(1,$articlecount)]->topic->name }}</a>
                            <div class="ui large header mt-0">{{ $articles[rand(1,$articlecount)]->title }}</div>
                            <div class="ui text">
                                {{ $articles[rand(1,$articlecount)]->description }} 
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!--  -->
            <div class="column mt-20">
                <div class="ui large header">   
                    INNOVATION
                </div>
                <div class="ui divider"></div>
                <div class="ui divided stackable relaxed items">
                    @php
                        $vals = range(1, $articlecount);
                        shuffle($vals);
                        $count = 0;
                    @endphp
                    @foreach($vals as $val)
                    @php
                        if($count == 3) break;
                    @endphp
                    <div class="item">
                        <div class="ui small image">
                            <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" class="ui fluid image">
                        </div>
                        <div class="content">
                            <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase d-block">{{ $articles[$val]->topic->name }}</a>
                            <div class="ui large header mt-0">{{ $articles[$val]->title }}</div>
                            <div class="ui text">
                                {{ $articles[$val]->description }} 
                            </div>
                        </div>
                    </div>
                    @php $count++ @endphp
                    @endforeach
                    <!-- <div class="item">
                        <div class="ui small image">
                            <img src="{{ asset('img/articles/' . $articles[rand(1,$articlecount)]->image) }}" class="ui fluid image">
                        </div>
                        <div class="content">
                            <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase d-block">{{ $articles[rand(1,$articlecount)]->topic->name }}</a>
                            <div class="ui large header mt-0">{{ $articles[rand(1,$articlecount)]->title }}</div>
                            <div class="ui text">
                                {{ $articles[rand(1,$articlecount)]->description }} 
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui small image">
                            <img src="{{ asset('img/articles/' . $articles[rand(1,$articlecount)]->image) }}" class="ui fluid image">
                        </div>
                        <div class="content">
                            <a href="{{ route('errors.cs') }}" class="ui small blue text uppercase d-block">{{ $articles[rand(1,$articlecount)]->topic->name }}</a>
                            <div class="ui large header mt-0">{{ $articles[rand(1,$articlecount)]->title }}</div>
                            <div class="ui text">
                                {{ $articles[rand(1,$articlecount)]->description }} 
                            </div>
                        </div>
                    </div> -->
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
    <!-- <div class="ui stackable grid">
        <div class="ten wide column">
            <div class="ui large header">   
                AFRICA'S ENTREPRENEUR'S PROFILE
                <i class="right blue arrow icon"></i>
            </div>
            <div class="ui table x-scroll">
                <table class="ui selectable celled orange unstackable single line table">
                    <thead>
                        <tr>
                            <th>
                                <div class="ui center aligned large header">RANK</div>    
                            </th>
                            <th>
                                <div class="ui large header">DETAILS</div>    
                            </th>
                            <th>
                                <div class="ui large header center aligned">INVESTMENT</div>    
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="ui center aligned header">#1</div>
                            </td>
                            <td>
                                <div class="ui item">
                                    <div class="ui tiny circular image">
                                        <img src="{{asset('img/people/gospel.jpg')}}">
                                    </div>
                                    <a class="ml-20 ui header">Gospel Obi</a>
                                    <i class="ml-20 ng flag"></i>
                                </div>
                            </td>
                            <td>
                                <div class="ui tiny center aligned header">$1.1M - $2.2M</div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="ui center aligned header">#2</div>
                            </td>
                            <td>
                                <div class="ui item">
                                    <div class="ui tiny circular image">
                                        <img src="{{asset('img/people/chris.jpg')}}">
                                    </div>
                                    <a class="ml-20 ui header">Chris Jamie</a>
                                    <i class="ml-20 gh flag"></i>
                                </div>
                            </td>
                            <td>
                                <div class="ui tiny center aligned header">$229K - $1.7M</div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="ui center aligned header">#3</div>
                            </td>
                            <td>
                                <div class="ui item">
                                    <div class="ui tiny circular image">
                                        <img src="{{asset('img/people/daniel.jpg')}}">
                                    </div>
                                    <a class="ml-20 ui header">Jill Daniel</a>
                                    <i class="ml-20 us flag"></i>
                                </div>
                            </td>
                            <td>
                                <div class="ui tiny center aligned header">$865K - $3.6M</div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="ui center aligned header">#4</div>
                            </td>
                            <td>
                                <div class="ui item">
                                    <div class="ui tiny circular image">
                                        <img src="{{asset('img/people/elliot.jpg')}}">
                                    </div>
                                    <a class="ml-20 ui header">John Elliot</a>
                                    <i class="ml-20 uk flag"></i>
                                </div>
                            </td>
                            <td>
                                <div class="ui tiny center aligned header">$525K - $2.6M</div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="ui center aligned header">#5</div>
                            </td>
                            <td>
                                <div class="ui item">
                                    <div class="ui tiny circular image">
                                        <img src="{{asset('img/people/helen.jpg')}}">
                                    </div>
                                    <a class="ml-20 ui header">Jenny Helen</a>
                                    <i class="ml-20 au flag"></i>
                                </div>
                            </td>
                            <td>
                                <div class="ui tiny center aligned header">$169K - $398K</div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            
            <div class="ui grid">
                <div class="ui centered four wide computer ten wide mobile column">
                    <div class="ui fluid large orange button">View Full List</div>
                </div>
            </div>
            
            
        </div>
        <div class="six wide column">
            <div class="ui raised fluid padded center aligned segment">
                <div class="content">
                    <div class="ui large center aligned header">
                        <i class="bitcoin icon"></i>
                        The Business Quiz
                    </div>
                    <div class="ui text">
                        Take this short quiz and find the perfect entrepreneurship for you to start! 
                    </div>
                    <div class="ui header">What Industry are you Interested In?</div>
                    <div class="ui red fluid huge button mt-10">INSPIRATION</div>
                    <div class="ui pink fluid huge button mt-10">LEADERSHIP</div>
                    <div class="ui brown fluid huge button mt-10">MARKETING</div>
                    <div class="ui primary fluid huge button mt-10">SOCIAL MEDIA</div>
                    <div class="ui purple fluid huge button mt-10">FINANCE</div>
                    <div class="ui green fluid huge button mt-10">TECHNOLOGY</div>
                    <div class="ui yellow fluid huge button mt-10">INNOVATION</div>
                </div>
                
            </div>
            
        </div>
    </div> -->
    <!--  -->

    <!--  -->
    <!-- <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div> -->
    <!--  -->

    <!--  -->
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
                @php
                    if($count == 3) break;
                @endphp
                <div class="ui card">
                    <div class="ui image">
                        <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" alt="">
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
                                <i class="clock icon"></i>
                                {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                            </div>
                            <div class="ui vertically fitted segment">
                                <i class="book reader icon"></i>
                                {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                            </div>
                        </div>
                    </div>
                </div>
                @php $count++ @endphp
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
                        @php
                            $val = rand(1, $articlecount)
                        @endphp
                        <div class="ui fluid card">
                            <div class="ui image">
                                <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" alt="">
                            </div>
                            <div class="content">
                                <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                <a href="{{ route('articles.read', $articles[$val]->id) }}">
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
                                        <i class="clock icon"></i>
                                        {{ date('jS M', strtotime($articles[$val]->created_at)) }}
                                    </div>
                                    <div class="ui vertically fitted segment">
                                        <i class="book reader icon"></i>
                                        {{ round(str_word_count($articles[$val]->body) / 250) }} mins read
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="eight wide computer only column">
                        <!-- <div class="ui fluid horizontal cards"> -->
                            @php
                                $vals = range(1, $articlecount);
                                shuffle($vals);
                                $count = 0;
                            @endphp
                            @foreach($vals as $val)
                            @php
                                if($count == 3) break;
                            @endphp
                            <div class="ui fluid horizontal card">
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($articles[$val]->topic->name)) }}" class="ui small blue text uppercase">{{ $articles[$val]->topic->name }}</a>
                                    <a href="{{ route('articles.read', $articles[$val]->id) }}">
                                        <div class="ui large header mt-0">{{ $articles[$val]->title }}</div>
                                    </a>
                                    <div class="ui text">
                                        {{ $articles[$val]->description }}
                                    </div>
                                </div>
                                <div class="ui fluid right floated image">
                                    <img src="{{ asset('img/articles/' . $articles[$val]->image) }}" class="ui image image-fit">
                                </div>
                            </div>
                            @php $count++ @endphp
                            @endforeach
                            <!--  -->
                            <!-- <div class="ui fluid horizontal card">
                                <div class="content">
                                    <a href="{{ route('errors.cs') }}" class="ui small blue text">MARKETING</a>
                                    <div class="ui header mt-0">Learn What Marketing Is and How It Is Used</div>
                                    <div class="ui text">
                                        Marketing is teaching consumers why they should choose you over your competitors.
                                    </div>
                                </div>
                                <div class="ui fluid right floated image">
                                    <img src="{{asset('img/bg/business3.jpg')}}" class="ui fluid image">
                                </div>
                            </div> -->
                            <!--  -->
                            <!-- <div class="ui fluid horizontal card">
                                <div class="content">
                                    <a href="{{ route('errors.cs') }}" class="ui small blue text">OPPORTUNITIES</a>
                                    <div class="ui header mt-0">Jobs in Nigeria - Latest Job Vacancies in Nigeria 2019</div>
                                    <div class="ui text">
                                        UWE Bristol is a thriving, modern university, offering a wide range of employment-enhancing opportunities.
                                    </div>
                                </div>
                                <div class="ui fluid right floated image">
                                    <img src="{{asset('img/bg/business4.png')}}" class="ui fluid image">
                                </div>
                            </div> -->
                        <!-- </div> -->
                    </div>
                </div>
                
            </div>
        </div>
        <div class="ui centered four wide computer ten wide mobile column">
            <div class="ui large fluid orange button">Show More</div>
        </div>
    </div>
    <!--  -->

    <!--  -->
    <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div>
    <!--  -->

    <!--  -->
    <!-- <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui large header">
                <small class="ui right floated tiny blue header">Ads by Google</small>
                SPONSORED BUSINESS CONTENT
            </div>
            <div class="ui divider"></div>
            <div class="ui four stackable cards">
                <div class="card">
                    <a class="image" href="#">
                        <img src="{{asset('img/bg/business4.png')}}">
                    </a>
                    <div class="content">
                        <a class="header" href="#">Riding the Waves</a>
                        <div class="meta">
                        <a>Last Seen 2 days ago</a>
                        </div>
                    </div>
                    <div class="ui bottom attached basic button">
                        NTA News
                    </div>
                </div>
                <div class="card">
                    <a class="image" href="#">
                        <img src="{{asset('img/bg/business3.jpg')}}">
                    </a>
                    <div class="content">
                        <a class="header" href="#">An Advertising Agency</a>
                        <div class="meta">
                        <a>Last Seen 2 days ago</a>
                        </div>
                    </div>
                    <div class="ui bottom attached basic button">
                        Silverbird Cinemas
                    </div>
                </div>
                <div class="card">
                    <a class="image" href="#">
                        <img src="{{asset('img/bg/business2.png')}}">
                    </a>
                    <div class="content">
                        <a class="header" href="#">Facebook: Stop Censoring Hemp</a>
                        <div class="meta">
                        <a>Last Seen 2 days ago</a>
                        </div>
                    </div>
                    <div class="ui bottom attached basic button">
                        FAAN
                    </div>
                </div>
                <div class="card">
                    <a class="image" href="#">
                        <img src="{{asset('img/bg/business3.jpg')}}">
                    </a>
                    <div class="content">
                        <a class="header" href="#">3 Lessons About Setting Your Price</a>
                        <div class="meta">
                        <a>Last Seen 2 days ago</a>
                        </div>
                    </div>
                    <div class="ui bottom attached basic button">
                        Nigerian Customs
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--  -->

    <!--  -->
    <!-- <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div> -->
    <!--  -->

    <!--  -->
    <!-- <div class="ui grid">
        <div class="sixteen wide column">
            <div class="ui large header">
                LATEST VIDEOS
                <i class="arrow right icon blue"></i>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="twelve wide column">

                    <div class="ui fluid card">
                        <div class="ui embed" data-source="youtube" data-id="86unGITRPLs" data-placeholder="https://img.youtube.com/vi/86unGITRPLs/hqdefault.jpg"></div>
                        <div class="content">
                            <a class="header" href="#">Why This Entrepreneur Is Focused on Improving Men's Health Nationwide</a>
                            <div class="text">A health scare inspired a charity that takes a unique approach to improving men's health.</div>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    <div class="ui cards">
                        <div class="ui fluid card">
                            <a class="image" href="#">
                                <img src="{{asset('img/bg/business.png')}}">
                            </a>
                            <div class="content">
                                <a class="header" href="#">Why This Entrepreneur Is Focused on</a>
                            </div>
                        </div>
                        <div class="ui fluid card">
                            <a class="image" href="#">
                                <img src="{{asset('img/bg/business.png')}}">
                            </a>
                            <div class="content">
                                <a class="header" href="#">Why This Entrepreneur Is Focused on</a>
                            </div>
                        </div>
                        <div class="ui fluid card">
                            <a class="image" href="#">
                                <img src="{{asset('img/bg/business.png')}}">
                            </a>
                            <div class="content">
                                <a class="header" href="#">Why This Entrepreneur Is Focused on</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--  -->

    <!--  -->
    <!-- <div class="ui fluid bordered image my-50">
        <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
    </div> -->
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
                    <!-- <div class="column">
                        <div class="ui very padded center aligned secondary segment">
                            <div class="ui small circular image">
                                <img src="{{asset('img/people/stevie.jpg')}}" alt="">
                            </div>
                            <div class="ui header">Susan Gunelius</div>
                            <div class="ui text">Marketing, Branding, Copywriting</div>
                            <div class="ui orange button mt-10">Follow</div>
                            <div class="ui divider"></div>
                            <div class="ui text text-left">TOP STORY</div>
                            <div class="ui left aligned small header mt-0">10 Laws of Social Media Marketing</div>
                        </div>
                    </div> -->
                    
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
                    
                    <!-- <div class="column">
                        <div class="ui very padded center aligned secondary segment">
                            <div class="ui small circular image">
                                <img src="{{asset('img/people/chris.jpg')}}" alt="">
                            </div>
                            <div class="ui header">Jamie Foster</div>
                            <div class="ui text">Email and Social Media Expert</div>
                            <div class="ui orange button mt-10">Follow</div>
                            <div class="ui divider"></div>
                            <div class="ui text text-left">TOP STORY</div>
                            <div class="ui left aligned small header mt-0">This Simple Tool Makes It Easy to Build and Host a Website</div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    
</div>
<!--  -->


@endsection

@section('custom_script')

    $('.ui.embed').embed();

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