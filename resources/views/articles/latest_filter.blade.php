@extends('templates.master')

@section('title', 'IABC Africa - Most Recent Articles')

@section('content')

    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="sixteen wide column">
                <div class="ui stackable grid">
                    <div class="three wide computer only column"></div>
                    <div class="ui ten wide centered column">
                        <div class="ui huge centered header">Most Recent Articles</div>
                    </div>
                    <div class="ui three wide column">
                    @auth
                    @if(Auth::user()->author != "")
                        <a href="{{ route('articles.create') }}" class="ui fluid orange button">Write An Article</a>
                    @endif
                    @endauth
                    </div>
                </div>
                <div class="ui divider"></div>
                <div class="ui grid">
                    <div class="sixteen wide column">

                        <div class="ui divided items">
                        @if(count($articles) != 0)
                            @foreach($articles as $article)
                            <div></div>
                            <div class="ui item border border-dark px-20 rounded">
                                <div class="image">
                                    <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}">
                                </div>
                                <div class="content">
                                    <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui small blue text uppercase">{{ $article->topic->name }}</a>
                                    <a class="header d-block mt-5">{{ makeTitle($article->title) }}</a>
                                    <div class="meta text-italic">
                                        <span>{{ $article->description }}</span>
                                    </div>
                                    <div class="description article article_body mt-5">
                                        <p>
                                            {!! str_limit($article->body, $limit = 200, $end = '...') !!}
                                        </p>
                                    </div>
                                    <div class="ui divider"></div>
                                    <div class="extra">
                                        <div class="ui horizontal relaxed article_meta list mt-5 text-black">
                                            <div class="item">
                                                <div class="ui tiny text" data-tooltip="Author" data-position="bottom center">
                                                    <i class="user icon"></i>
                                                    <a href="{{ route('profiles.author', slug($article->user->username)) }}">
                                                        {{ $article->user->lastname.' '.$article->user->firstname[0].'.' }}
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- <div class="item">
                                                <div class="ui tiny text" data-tooltip="LIkes" data-position="bottom center">
                                                    <i class="like icon"></i>
                                                    50
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="ui tiny text" data-tooltip="Comments" data-position="bottom center">
                                                    <i class="comments icon"></i>
                                                    17
                                                </div>
                                            </div> -->
                                            <div class="item">
                                                <div class="ui tiny text" data-tooltip="Date Created" data-position="bottom center">
                                                    <i class="calendar alternate icon"></i>
                                                    {{ date('jS F, o', strtotime($article->created_at)) }}
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="ui tiny text" data-tooltip="Read Length" data-position="bottom center">
                                                    <i class="book reader icon"></i>
                                                    {{ round(str_word_count($article->body) / 250) }} mins read
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="ui small basic orange button border border-orange" id="readlist">Save to Readlist</div>
                                                <form id="readlist" action="{{ route('readlists.store') }}" method="post">
                                                    @csrf
                                                    <input hidden type="text" name="article_id" id="" value="{{ $article->id }}">
                                                </form>
                                            </div>
                                        </div>
                                        <a href="{{ route('articles.read', slug($article->title)) }}" class="ui large right aligned right floated orange button">
                                            Read
                                        </a>
                                        <!--  -->
                                        <!-- <div class="ui small right floated red button">
                                            Delete
                                        </div> -->
                                        
                                        
                                        <!--  -->
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="ui divider my-0"></div>
                            
                            @endforeach
                        @else
                            <div class="ui red centered header">No Articles Found!</div>
                        @endif

                            <div class="ui center aligned pagination grid">
                                <div class="ui sixteen wide column">
                                    {{ $articles->links('partials.semantic-ui') }}
                                </div>
                                <div class="ui column pb-0"></div>
                            </div>
                            <!--  -->
                            
                        </div>
                        
                    </div>
                </div>
                <!--  -->
                
            </div>
        </div>
    </div>      
@endsection

@section('custom_script')

    $('div#readlist').click(function(e) {
        e.preventDefault();
        $(this).addClass('loading');
        $('form#readlist').submit();
    });

    $('.article_body').find('img').remove();

    var pagactive = $('pagination.grid').length;

    if(pagactive == 0) {
        $('.pagination.grid').hide();
    }

    var pagcount = $('.pagination.menu').children().length;
	
    if(pagcount > 7) {
        // hide all except active, icon, 1 - 3 and last
        $('.pagination.menu').find('.item').not('.active, .icon, :nth-child(-n+4), :nth-last-child(2)').hide(); // Hide all not icon, last and greater than 3
        $('.pagination.menu').find('.item:contains("...")').hide();
        
        var activepag = $('.pagination.menu').find('.item.active');
        var activepagnum = parseInt(activepag.text());
        
        var lastpag = $('.pagination.menu').find('.item:nth-last-child(2)');
        var lastpagnum = parseInt(lastpag.text());
        
        var firstpag = $('.pagination.menu').find('.item:nth-child(2)');
        var firstpagnum = parseInt(firstpag.text());
        
        // Show ... before last
        if(lastpagnum > activepagnum + 2 || activepag.length == 0){
            lastpag.before('<a class="icon item disabled" aria-disabled="true">...</a>');
        }
        
        
        // To show active, one before and one after
        
        $('.pagination.menu').find('.item').each(function() {
            $(this).filter(function() {
                return ($(this).text() == (activepagnum + 1) || $(this).text() == (activepagnum - 1));
            }).show();
        });
        
        
        
        if((activepagnum == 3 && pagcount == 8) || (activepagnum == 4 && pagcount == 9)) {
            $('.pagination.menu').find('.item').show();
            $('.pagination.menu').find('.item:contains("...")').hide();
        } else if(activepagnum > 4) {
            $('.pagination.menu').find('.item').each(function() {
                var pagnum = parseInt($(this).text());
                if((pagnum < activepagnum - 1) && (pagnum != 1)) {
                    // alert('goat');
                    $(this).hide();
                }
            });
        }
        
        // Show ... after first
        if(activepagnum > 4) {
            firstpag.after('<a class="icon item disabled" aria-disabled="true">...</a>');
        }
        
        
    }

@endsection


@section('custom_window_width_script')

    $('.article_meta').removeClass('horizontal');

@endsection

@section('custom_resize_if_script')

    $('.article_meta').addClass('horizontal');

@endsection

@section('custom_resize_else_script')

    $('.article_meta').removeClass('horizontal');

@endsection