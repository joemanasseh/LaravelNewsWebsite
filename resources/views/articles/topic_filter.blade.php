@extends('templates.master')

@section('title', 'IABC Africa - All '. $topic->name .' Articles')

@section('content')

    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="sixteen wide column">
                <div class="ui stackable grid">
                    <!-- <div class="three wide computer only column"></div> -->
                    <div class="ui twelve wide centered column">
                    
                        <div class="ui huge centered header">
                            All {{ $topic->name }} Articles
                            <a href="{{ route('articles.create', ['linkedtopic' => $topic->id]) }}" class="ui orange right floated create button">Write Here</a>
                        </div>
                        <div class="ui divider"></div>
                        <div class="ui grid">
                            <div class="sixteen wide column">
                                <div class="ui divided items">
                                @if(count($topicarticles) != 0)
                                    @foreach($topicarticles as $topicarticle)
                                    <div class=""></div>
                                    <div class="ui item border border-dark rounded p-20">
                                        <div class="image">
                                            <img src="{{ asset('img/articles/' . sprintf('%06d', $topicarticle->id) . '-' . slug($topicarticle->title) . '/featured/' . $topicarticle->image) }}">
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('articles.read', slug($topicarticle->title)) }}" class="header d-block mt-5">{{ $topicarticle->title }}</a>
                                            <div class="meta text-italic">
                                                <span>{{ $topicarticle->description }}</span>
                                            </div>
                                            <div class="description article mt-5">
                                                <p>
                                                    {!! str_limit($topicarticle->body, $limit = 200, $end = '...') !!}
                                                </p>
                                            </div>
                                            <div class="ui divider"></div>
                                            <div class="extra">
                                                <div class="ui horizontal article_meta list mt-5 text-black">
                                                    <div class="item">
                                                        <div class="ui tiny text">
                                                            <i class="user icon"></i>
                                                            <a href="{{ route('profiles.author', slug($topicarticle->user->username)) }}">
                                                                {{ $topicarticle->user->lastname.' '.$topicarticle->user->firstname }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ui tiny text">
                                                            <i class="calendar alternate icon"></i>
                                                            {{ date('jS F', strtotime($topicarticle->created_at)) }}
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ui tiny text">
                                                            <i class="book reader icon"></i>
                                                            {{ round(str_word_count($topicarticle->body) / 250) }} mins
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  -->
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui divider my-0"></div>
                                    @endforeach
                                @else
                                    <div class="ui red centered header">No Articles Found!</div>
                                @endif

                                    <!--  -->
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="ui four wide column">
                        <div class="ui huge centered header">{{ $topic->name }} Videos</div>
                        <div class="ui divider"></div>
                        <div class="ui grid">
                            <div class="sixteen wide column">
                                <div class="ui divided items">
                                    <div class="ui red centered header">No Videos Found!</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!--  -->
                
            </div>
        </div>
    </div>      
@endsection


@section('custom_window_width_script')

    $('.article_meta').removeClass('relaxed');
    $('.create.button').removeClass('right floated').before('<br>');

@endsection

@section('custom_resize_if_script')

    $('.article_meta').addClass('relaxed');
    $('.create.button').addClass('right floated').siblings('br').remove();

@endsection

@section('custom_resize_else_script')

    $('.article_meta').removeClass('relaxed');
    $('.create.button').removeClass('right floated').before('<br>');

@endsection