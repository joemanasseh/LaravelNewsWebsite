@extends('templates.master')

@section('title', 'IABC Africa - ' . $user->lastname.' '.$user->firstname)


@section('content')
<div class="mt45"></div>

<section class="ui grid">
    <div class="ui light-grey row p-20">
        <div class="sixteen wide column">
            <div class="ui container">
                <div class="ui grid">
                    <div class="ui sixteen wide column">
                        <div class="ui items">
                            <div class="ui item">
                                <div class="ui medium circular image">
                                    @if(!empty($user->photo))
                                        <img src="{{ asset('img/users/'. $user->photo) }}">
                                    @else
                                        <img src="{{ asset('img/users/head.jpg') }}">
                                    @endif
                                </div>
                                <div class="middle aligned content">
                                    <div class="content_wrap">
                                        <div class="ui huge header">
                                            {{ $user->lastname.' '.$user->firstname }}
                                            @if(!empty($user->othername))
                                                {{ $user->othername }}
                                            @endif
                                        </div>
                                        <div class="description fs-1-5">
                                            {{ strtoupper($user->author) }}
                                        </div>
                                        <div class="meta fs-1-5 mt-15">
                                            {{ $user->job_desc }}
                                        </div>
                                        <div class="mt-20">
                                        @if(count($user->socialmedias) != 0)
                                            @foreach($user->socialmedias as $socialmedia)
                                            <a href="https://{{ $socialmedia->url }}"><i class="large circular {{ $socialmedia->icon }} link icon"></i></a>
                                            @endforeach
                                             <a href="mailto:{{ $user->email }}"><i class="large circular envelope link icon"></i></a>
                                        @else
                                            <a data-tooltip="No Social Media Registered"><i class="large circular question icon"></i></a>
                                        @endif
                                            <i class="icon"></i>
                                            <button class="ui orange button">Follow</button>
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
        <div class="ui twelve wide column">
            <div class="ui huge header">About {{ $user->lastname.' '.$user->firstname }}</div>
            <div class="ui fluid raised card">
                <div class="content p-20">
                    <div class="description fs-1-5 text-justify mt10">
                        @if(!empty($user->about))
                        <p>
                            {!! $user->about !!}
                        </p>
                        @else
                        <div class="ui tiny red centered header">No Description!</div>
                        @endif
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="ui huge header mt-50">Books By {{ $user->lastname.' '.$user->firstname }}</div>
            <div class="ui fluid raised card">
                
                <div class="content p-20">
                    <div class="ui  unstackable  items">
                    @if(count($user->books) != 0)
                        @foreach($user->books as $book)
                        <div class="item border border-orange rounded">
                            <a class="ui medium fluid image">
                                <img src="{{ asset('img/books/' . $book->cover) }}" class="ui fluid image">
                            </a>
                            <div class="content">
                                <br>
                                <div class="meta">
                                    <i class="ui yellow star icon mr-10"></i>
                                    F E A T U R E D
                                </div>
                                <div class="ui large header mt-10">
                                    {{ $book->title }}
                                    <div class="sub header text-bold mt-10">
                                        By {{ $user->lastname.' '.$user->firstname }}
                                    </div>
                                </div>
                                <div class="description fs-1-2 text-justify mt-15">
                                    <p>{{ $book->description }}</p>
                                </div>
                                <br>
                                <div class="ui text">
                                    <strong>ISBN</strong>: {{ $book->isbn }}
                                </div>
                                <div class="extra mt-20">
                                    <div class="ui orange button">Buy Now</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="ui red centered header">No Books Found!</div>
                    @endif
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="ui huge header mt-50">Articles By {{ $user->lastname.' '.$user->firstname }}</div>
            <div class="ui fluid raised card">
                <div class="content p-20">
                    <div class="ui divided items">
                    @if(count($authorarticles) != 0)
                        @foreach($authorarticles as $authorarticle)
                        <div class="ui item author_article">
                            <div class="image">
                                <img src="{{ asset('img/articles/' . sprintf('%06d', $authorarticle->id) . '-' . slug($authorarticle->title) . '/featured/' . $authorarticle->image) }}">
                            </div>
                            <div class="content">
                                <a href="{{ route('articles.read', slug($authorarticle->title)) }}" class="header d-block mt-5">{{ $authorarticle->title }}</a>
                                <div class="meta text-italic">
                                    <span>{{ $authorarticle->description }}</span>
                                </div>
                                <div class="description article mt-5">
                                    <p>
                                        {!! str_limit($authorarticle->body, $limit = 200, $end = '...') !!}
                                    </p>
                                </div>
                                <div class="ui divider"></div>
                                <div class="extra">
                                    <div class="ui horizontal relaxed article_meta list mt-5 text-black">
                                        <div class="item">
                                            <a href="{{ route('profiles.author', slug($authorarticle->user->username)) }}">
                                                <div class="ui tiny text">
                                                    <i class="user icon"></i>
                                                    {{ $authorarticle->user->lastname.' '.$authorarticle->user->firstname }}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="item">
                                            <div class="ui tiny text">
                                                <i class="calendar alternate icon"></i>
                                                {{ date('jS F', strtotime($authorarticle->created_at)) }}
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="ui tiny text">
                                                <i class="book reader icon"></i>
                                                {{ round(str_word_count($authorarticle->body) / 250) }} mins
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    
                                </div>
                            </div>
                        </div>
                        <div class="ui article divider my-0"></div>
                        @endforeach
                    @else
                        <div class="ui red centered header">No Articles Found!</div>
                    @endif
                        <div class="ui grid">
                            <div class="six wide computer five wide mobile column pt-0 my-0"></div>
                            <div class="four wide computer six wide mobile column pt-0 mt-0">
                                <div class="ui fluid orange button show_all mt-10">Show All</div>
                            </div>
                            <div class="six wide computer five wide mobile column pt-0 my-0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="ui huge header mt-50">Videos By {{ ucfirst($user->lastname.' '.$user->firstname) }}</div>
            <div class="ui fluid raised card">
                <div class="content p-20">
                    <div class="ui divided items">
                        <div class="ui red centered header">No Videos Found!</div>
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

    $('.show_all').hide();
    
    var article_count = $('.author_article').length;
    if(article_count > 3) {
        $('.author_article').hide();
        $('.article.divider').hide();
        $('.author_article:lt(3)').show();
        $('.article.divider:lt(3)').show();
        $('.show_all').show();
    }

    $('button.show_all').click(function() {
        $('.author_article,.article.divider').show();
        $(this).hide();
    });

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

@endsection

@section('custom_resize_if_script')

$('.content_wrap').removeClass('text-center');

@endsection

@section('custom_resize_else_script')

    $('.content_wrap').addClass('text-center');

@endsection
