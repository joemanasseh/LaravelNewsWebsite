@extends('templates.master')

@section('extra_links')
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5d92bc772303400012f9304f&product=inline-share-buttons" async="async"></script>
@endsection

@section('title', 'IABC Africa - ' . titleCase($article->title))

@section('article_meta')
    <meta property="og:title" content="{{ titleCase($article->title) }}">
    <meta property="og:description" content="{{ $article->description }}">
    <meta property="og:image" content="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}">
    <meta property="og:url" content="{{ route('articles.read', slug($article->title)) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')

    <div class="ui container mt-20">
        <div class="ui grid">
            <!-- <div class="ui ten wide centered blue column"></div> -->

            <div class="fourteen wide computer sixteen wide mobile centered column post_show_main">
                <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui blue text text-bold uppercase">{{ $article->topic->name }}</a>
                <div class="ui large header mt-0">
                    <div class="ui large header mt-0 article_title" data-title="{{ $article->id }}">
                        {{ titleCase($article->title) }}
                    </div>
                    <div class="sub header text-italic">{{ $article->description }}</div>
                </div>
                <div class="ui divider"></div>
                <div class="ui grid">
                <div class="five wide computer sixteen wide mobile column">
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
                    <!-- <div class="ui one wide computer three wide mobile middle aligned column">
                        <div class="ui center aligned header">
                            00
                            <div class="sub header">Shares</div>
                        </div>
                    </div>
                    <div class="one wide computer three wide mobile center aligned column" data-tooltip="Share on Facebook">
                        <i class="ui large blue facebook f circular link icon"></i>
                    </div>
                    <div class="one wide computer three wide mobile center aligned column" data-tooltip="Tweet this Article">
                        <i class="ui large blue twitter circular link icon"></i>
                    </div>
                    <div class="one wide computer three wide mobile center aligned column" data-tooltip="Share on LinkedIn">
                        <i class="ui large blue linkedin in circular link icon"></i>
                    </div>
                    <div class="one wide computer three wide mobile center aligned column" data-tooltip="Share on Linkify">
                        <i class="ui large linkify circular link icon"></i>
                    </div> -->
                    <div class="three wide computer eight wide mobile center aligned column">
                        <div class="ui fluid basic large orange button border border-orange" id="readlist">Save to Readlist</div>
                        <form id="readlist" action="{{ route('readlists.store') }}" method="post">
                            @csrf
                            <input hidden type="text" name="article_id" id="" value="{{ $article->id }}">
                        </form>
                    </div>
                    <div class="three wide computer eight wide mobile right floated middle aligned column">
                        
                        <a @if(!empty($nextarticle)) href="{{ route('articles.read', slug($nextarticle->title)) }}" @endif class="@if(empty($nextarticle)) disabled @endif ui right floated blue header">NEXT ARTICLE</a>
                        
                    </div>
                </div>
                <div class="ui divider"></div>
                <div class="ui stackable grid">
                    <div class="twelve wide column">
                        <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}" alt="" class="ui fluid image">
                        <div class="ui text-italic right floated large sub header my-0 d-block text-ucfirst">{{ !empty($article->image_credit) ? 'Image Credit: '.$article->image_credit : '' }}</div>
                        <div class="ui large header">
                            <img src="{{ asset('img/users/' . $article->user->photo) }}" alt="" class="ui circular image">
                            <div class="content">
                                <a href="{{ route('profiles.author', slug($article->user->username)) }}">
                                    {{ $article->user->lastname.' '.$article->user->firstname }}
                                </a>
                                <div class="ui sub header text-bold">{{ $article->user->author }}</div>
                                <div class="sub header text-italic">{{ $article->user->job_desc }}</div>
                                <div class="ui icons mt-10">
									@if(count($user->socialmedias) != 0)
										@foreach($user->socialmedias as $socialmedia)
										<a href="https://{{ $socialmedia->url }}"><i class="ui small blue {{ $socialmedia->icon }} link icon"></i></a>
										@endforeach
										 <a href="mailto:{{ $user->email }}"><i class="ui small blue envelope link icon"></i></a>
									@else
										<a data-tooltip="No Social Media Registered"><i class="large circular question icon"></i></a>
									@endif
								</div>
                                <!-- <div class="ui icons mt-10">
                                    <i class="ui small blue circular twitter icon"></i>
                                    <i class="ui small blue circular linkedin in icon"></i>
                                    <i class="ui small blue circular home icon"></i>
                                    <i class="ui small circular swatchbook icon"></i>
                                </div> -->
                            </div>
                        </div>
                        <div class="ui very relaxed horizontal list">
                            <div class="item">
                                <div class="ui tiny header">
                                    <i class="calendar alternate icon"></i>
                                    {{ date('jS F, o', strtotime($article->created_at)) }}
                                </div>
                            </div>
                            <div class="item">
                                <div class="ui tiny header">
                                    <i class="book reader icon"></i>
                                    {{ round(str_word_count($article->body) / 250) }} mins read
                                </div>
                            </div>
                        </div>
                        <div class="tiny sub header mt-10">
                            Opinions expressed by <em>IABC</em> contributors are their own. 
                        </div>
                        <div class="ui header post-body article text-justify">
                            {!! $article->body !!}
                        </div>
                    </div>
                    <div class="four wide column">
                        <!-- <img src="{{ asset('img/bg/business3.jpg') }}" alt="" class="ui fluid image"> -->
                        <div class="ui large dividing header">RELATED ARTICLES</div>
                        <div class="ui divided list">
                        @if(count($topicarticles) != 0)
                        @foreach($topicarticles as $topicarticle)
                            <div class="ui item">
                                <div class="content mt-10">
                                    <a href="{{ route('topic.articles', slug($topicarticle->topic->name)) }}" class="ui tiny blue text">{{ strtoupper($topicarticle->topic->name) }}</a>
                                    <a href="{{ route('articles.read', slug($topicarticle->title)) }}">
                                        <div class="ui header mt-0">{{ $topicarticle->title }}</div>
                                    </a>
                                    <div class="ui text mt-10">
                                        {{ $topicarticle->description }} 
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="ui basic horizontal center aligned segments">
                                        <div class="ui vertically fitted segment">
                                            <i class="user icon"></i>
                                            <a href="{{ route('profiles.author', slug($topicarticle->user->username)) }}">
                                                {{ $topicarticle->user->lastname.' '.$topicarticle->user->firstname[0].'.' }}
                                            </a>
                                        </div>
                                        <div class="ui vertically fitted segment">
                                            <i class="book reader icon"></i>
                                            {{ round(str_word_count($topicarticle->body) / 250) }} mins
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        @endforeach
                        @else
                            <div class="ui red centered header">No Related Articles</div>
                        @endif
                        </div>
                    </div>
                </div>
                <!--  -->

                <!--  -->
                
            </div>
        </div>
        <!--  -->

        <!--  -->
        <div class="ui fluid bordered image my-50">
            <img src="{{asset('img/bg/ad_placeholder.png')}}" alt="">
        </div>
        <!--  -->

    </div>

@endsection


@section('custom_script')

var article_title = $('.article_title').attr('data-title');

$('div[data-tooltip="Share on Facebook"]').click(function(e) {
    e.preventDefault();
    alert(article_title);
    FB.ui({
        method: 'share',
        href: 'https://iabcafrica.com/article/' + article_title,
    }, function(response){});
});


$('div#readlist').click(function(e) {
    e.preventDefault();
    $(this).addClass('loading');
    $('form#readlist').submit();
});

@endsection
