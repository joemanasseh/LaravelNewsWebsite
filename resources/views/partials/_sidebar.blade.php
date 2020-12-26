<div class="ui sidebar inverted large vertical menu">
    <span class="item d-block sidebar_off">
        <div class="ui inverted list">
            <div class="item">
                <div class="ui very padded header">
                    <i class="ui small times icon"></i>
                    IABC Africa
                </div>
            </div>
        </div>
    </span>
    @auth()
    @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
    <span class="item d-block drop_item">
        <div class="ui accordion">
            <div class="title dropdown_item">
                <div class="ui inverted list">
                    <div class="item">
                        <div class="content_item mb-1 centered">
                            <div class="ui fluid labeled button" tabindex="0">
                                <div class="ui fluid button">
                                    <div class="ui inverted orange header">ADMIN PANEL</div>
                                </div>
                                <div class="ui basic icon label">
                                    <i class="large orange angle left icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ui inverted list p-0">
                    <div class="left aligned item">
                        <div class="list p-0">
                            @if(Auth::user()->role == 'superadmin')
                            <div class="item">
                                <a class="ui fluid inverted large orange button text-left">Dashboard</a>
                            </div>
                            <div class="item">
                                <a href="{{ route('users.index') }}" class="ui fluid inverted large orange button text-left">Users</a>
                            </div>
                            <div class="item">
                                <a href="{{ route('sidebars.index') }}" class="ui fluid inverted large orange button text-left">Sidebar</a>
                            </div>
                            @endif
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <div class="ui item">
                                <a href="{{ route('articles.index') }}" class="ui fluid inverted large orange button text-left">Articles</a>
                            </div>
                            <div class="ui item">
                                <a href="{{ route('topics.index') }}" class="ui fluid inverted large orange button text-left">Topics & Subtopics</a>
                            </div>
                            @endif
                            @if(Auth::user()->role == 'superadmin')
                            <div class="ui item">
                                <a class="ui fluid inverted large orange button text-left">Business Profile</a>
                            </div>
                            <div class="ui item">
                                <a class="ui fluid inverted large orange button text-left">Subscriptions</a>
                            </div>
                            @endif
                            <!-- <div class="item">
                                <div class="ui fluid large labeled button" tabindex="0">
                                    <a class="ui fluid orange button">
                                        <i class="heart icon"></i> Like
                                    </a>
                                    <span class="ui basic orange left pointing label">
                                        1,048
                                    </span>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </span>
    @endif
    @endauth()
    <span class="item d-block drop_item">
        <div class="ui inverted accordion">
            <div class="title p-0 dropdown_item">
                <div class="ui inverted list">
                    <div class="item">
                        <div class="ui right floated content">
                            <i class="angle left icon"></i>
                        </div>
                        <div class="content_item mb-1">
                            TOPICS
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ui inverted relaxed link list pt-0">
                    <div class="item">
                        <div class="list pt-0">
                            <div class="item">
                                <div class="ui inverted relaxed animated list">
                                @foreach($activetopics as $activetopic)
                                <a href="{{ route('topic.articles', slug($activetopic->name)) }}" class="item">{{ $activetopic->name }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </span>
    @foreach($activesidebars as $activesidebar)
    <a href="{{ route('home') . '/' . $activesidebar->link }}" class="item">
        <div class="ui inverted list">
            <div class="item uppercase">
                {{ $activesidebar->name }}
            </div>
        </div>
    </a>
    @endforeach
    
    
    <!-- <a class="item">
        <div class="ui inverted list">
            <div class="item">
                WOMEN ENTREPRENEUR
            </div>
        </div>
    </a>
    <a class="item">
        <div class="ui inverted list">
            <div class="item">
                VIDEOS
            </div>
        </div>
    </a>
    <a class="item">
        <div class="ui inverted list">
            <div class="item">
                IABC AFRICA 1000
            </div>
        </div>
    </a>
    <a class="item">
        <div class="ui inverted list">
            <div class="item">
                AGRIBUSINESS
            </div>
        </div>
    </a>
    <a class="item">
        <div class="ui inverted list">
            <div class="item">
                OPPORTUNITIES
            </div>
        </div>
    </a>
    <a class="item">
        <div class="ui inverted list">
            <div class="item">
                CONTACT US
            </div>
        </div>
    </a> -->
</div>

