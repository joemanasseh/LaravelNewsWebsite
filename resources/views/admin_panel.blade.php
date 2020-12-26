@extends('templates.master')

@section('title', 'IABC Africa - Admin Panel')

@section('content')



<section>
    <div class="ui container">
        <div class="ui grid">
            <div class="ui three wide column">
                <!-- <div class="ui fluid image"> -->
                    <div class="ui fluid huge vertical inverted pointing menu">
                        <a class="active orange item" data-tab="one">
                            Dashboard
                        </a>
                        <a class="item" data-tab="three">
                            Users
                        </a>
                        <a class="item" data-tab="two">
                            Articles
                        </a>
                        <a class="item" data-tab="three">
                            Topics & Subtopics
                        </a>
                        <a class="item" data-tab="three">
                            Business Profile
                        </a>
                        <a class="item" data-tab="three">
                            Subscriptions
                        </a>
                    </div>
                <!-- </div> -->
            </div>
            <div class="thirteen wide column">
                <div class="ui fluid orange segment" data-tab="one">one</div>
                <div class="ui fluid segment" data-tab="two">one</div>
                <div class="ui fluid segment" data-tab="three">one</div>
                <!-- <div class="ui segment" data-tab="two">two</div>
                <div class="ui segment" data-tab="three">three</div> -->
            </div>
        </div>
    </div>
</section>



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