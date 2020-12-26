

@auth
    @php
        session_start();
        $_SESSION["RF"]["subfolder"] = 'authors/' . Auth::user()->username;
    @endphp
@endauth

@extends('templates.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
@endsection

@section('title', 'IABC Africa - Create Article')




@section('content')

    <div class="ui container">
        <div class="ui very padded stackable grid">
            <div class="sixteen wide column">
                <div class="ui huge centered header">Create An Article</div>
                <div class="ui divider"></div>
                <div class="ui stackable grid">

                    <div class="sixteen wide column">
                        <!-- <div class="ui segment"> -->
                            <!-- <div class="ui two column stackable very relaxed grid"> -->
                                <!-- <div class="ui horizontal stackable segments"> -->
                                
                                <!-- <div class="middle aligned row"> -->
                                    <!-- <div class="ui very padded left aligned column"> -->
                                        <div class="ui fluid article segment">
                                            <p class="hidden linkedtopic">{{ Request::get('linkedtopic') }}</p> 
                                            @if(count($errors) > 0)
                                            <div class="ui error message">
                                                <i class="ui close icon"></i>
                                                <div class="header">Please check your input</div>
                                                <ul class="list">
                                                    @foreach($errors->all() as $input_error)
                                                    <li>{{ $input_error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <form id="article_create" class="ui large form" method="POST" action="{{route('articles.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="ui stackable two column grid">
                                                    <div class="ui leftarticle column">
                                                        <div class="ui two fields">
                                                            <div class="ui fluid field @if ($errors->has('topic')) error @endif">
                                                                <label>Topic</label>
                                                                <div class="ui topic search selection dropdown">
                                                                    <input name="topic" type="hidden">
                                                                    <i class="dropdown icon"></i>
                                                                    <div class="default text">Topic</div>
                                                                    <div class="menu">
                                                                        @foreach($topics as $topic)
                                                                        <div class="item topic" data-value="{{ $topic->id }}">
                                                                            {{ $topic->name }}
                                                                            
                                                                                @foreach($topic->subtopics as $subtopic) 
                                                                                    <div class="temp_item subtopic hidden" data-value="{{ $subtopic->id }}">
                                                                                        {{$subtopic->name}}
                                                                                    </div>
                                                                                @endforeach
                                                                            
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ui field @if ($errors->has('subtopic')) error @endif">
                                                                <label>Specified Keywords</label>
                                                                <div class="ui search selection dropdown subtopic disabled">
                                                                    <input name="subtopic" type="hidden">
                                                                    <i class="dropdown icon"></i>
                                                                    <div class="default text"><< Select Topic First</div>
                                                                    <div class="menu topic_subtopic">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="ui field @if ($errors->has('image')) error @endif">
                                                            <label for="">Featured Image</label>
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail w-100 ui rounded field-border">
                                                                        <img src="{{ asset('img/ui/placeholder-image.png') }}" class="img-fluid" alt="...">
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail lh-0"></div>
                                                                    <div>
                                                                        <span class="btn-default btn-file">
                                                                            <span class="fileinput-new ui button file-click left floated">Select Image</span>
                                                                            <span class="fileinput-exists ui button file-click left floated">Change</span>
                                                                            <input name="image" type="file" />
                                                                        </span>
                                                                        <a href="#pablo" class="ui red icon button fileinput-exists" data-dismiss="fileinput">
                                                                            <i class="times icon"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="field @if ($errors->has('image_credit')) error @endif">
                                                            <label>Image Credit</label>
                                                            <input type="text" name="image_credit" placeholder="Image Credit" value="{{ old('image_credit') }}">
                                                        </div>
                                                        <div class="field @if ($errors->has('title')) error @endif">
                                                            <label>Title</label>
                                                            <input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
                                                        </div>
                                                        <div class="field @if ($errors->has('description')) error @endif">
                                                            <label>Description</label>
                                                            <input type="text" name="description" placeholder="Short Description" value="{{ old('description') }}">
                                                        </div>
                                                    </div>

                                                    <div class="ui rightarticle column">
                                                        <div class="field @if ($errors->has('body')) error @endif w-100">
                                                            <label>Body</label>
                                                            <textarea name="body" id="editor">{{ old('body') }}</textarea>
                                                        </div>

                                                        <div class="hidden field">
                                                            <label>BodyImages</label>
                                                            <textarea name="bodyimage" id="bodyimage"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                                <!-- <img src="{{ asset('img/users/Gospel.jpg') }}" alt="" id="test"> -->

                                                <div class="ui three fields">
                                                    <div class="field"></div>
                                                    <div class="field"></div>
                                                    <div class="right floated field">
                                                        <button type="submit" class="ui large fluid orange button">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <!-- </div> -->
                                    <!-- <div class="ui center aligned column"> -->
                                        <!-- <div class="ui fluid segment w-50">

                                        </div> -->

                                        
                                    <!-- </div> -->
                                <!-- </div> -->
                                <!-- </div> -->

                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
                <!--  -->
                
            </div>
        </div>
    </div>

    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce/jquery.tinymce.min.js') }}"></script>

    <!-- <script src="{{ asset('js/ckeditor.js') }}"></script> -->
    <!-- <script src="https://example.com/ckfinder/ckfinder.js"></script> -->
    <!-- Image -->
    <!-- <script src="{{asset('js/image/core/jquery.min.js')}}" type="text/javascript"></script> -->
    <!-- <script src="{{asset('js/image/core/popper.min.js')}}" type="text/javascript"></script> -->
    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/image/plugins/moment.min.js')}}"></script> -->
    <!-- <script src="{{asset('js/image/plugins/bootstrap-selectpicker.js')}}"></script> -->
    <!-- <script src="{{asset('js/image/plugins/bootstrap-tagsinput.js')}}"></script> -->
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <!-- <script src="{{asset('js/image/plugins/jquery.flexisel.js')}}"></script> -->
    <!-- <script src="{{asset('js/image/plugins/nouislider.min.js')}}" type="text/javascript"></script> -->
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/image/custom.js')}}" type="text/javascript"></script> -->
    <!-- Image End -->
    
    <!-- <script src="{{ asset('fine-uploader/fine-uploader.min.js') }}"></script> -->
    

    <!-- <script src="{{ asset('js/dropzone.js') }}"></script> -->
    <!-- <script src="{{ asset('js/dropzone-config.js') }}"></script> -->

@endsection


@section('custom_script')

    var linkedtopic = $('p.linkedtopic').text();
    
    if(linkedtopic == "") {

    } else {
        $('.topic.dropdown').dropdown('set selected', $('p.linkedtopic').text());
        $('.topic_subtopic.menu').empty();
        $('.subtopic.dropdown').dropdown('clear');
        $('.topic.item[data-value='+ linkedtopic +']').children('.subtopic').clone().addClass('item').removeClass('hidden').appendTo('.topic_subtopic.menu');
        $('.subtopic.dropdown').removeClass('disabled').find('.default.text').text('Select Subtopic');
    }

    

    $('.topic.item').click(function() {

        $('.topic_subtopic.menu').empty();
        $('.subtopic.dropdown').dropdown('clear');
        $(this).children('.subtopic').clone().addClass('item').removeClass('hidden').appendTo('.topic_subtopic.menu');
        $('.subtopic.dropdown').removeClass('disabled').find('.default.text').text('Select Subtopic');

    });

    var tinyheight = $('.leftarticle.column').height();

    var tinyheightmoblie = $('textarea#editor').height();


    var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector: "textarea#editor",
        height: tinyheight - 23,
        toolbar_drawer: 'sliding',
        menubar: false,
        branding: false,
        //image_dimensions: false,
        image_class_list: [
            {title: 'Responsive', value: 'ui fluid image'},
            // {title: 'None', value: ''}
        ],
        content_style: 'img { width: 100%; height: auto; }',
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline | link image media | blockquote | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        relative_urls: false,
        external_filemanager_path:"{{url('tinymce/filemanager')}}/",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "{{url('tinymce')}}/filemanager/plugin.min.js"},

        setup: function(editor) {
            editor.on('init', function() {
                $('button[type="submit"]').click(function(e) {
                    e.preventDefault();

                    $(editor.getBody()).find('img').each(function() {
                        var imgsrc = $(this).attr('src');
                        var splitimgsrc = imgsrc.split('/');

                        var imgname = splitimgsrc[splitimgsrc.length-1];
                        $(this).attr('src', imgname);
                        $('textarea#bodyimage').append('|' + imgname);
                    });
                    
                    var bodyimages = $('textarea#bodyimage');
                    if((bodyimages.val()).charAt(0) == '|') {
                        bodyimages.val((bodyimages.val()).replace('|', ''));
                    }
                    
                    $('form#article_create').submit();
                });
            });
        }

    };

    tinymce.init(editor_config);



    $('.file-click').click(function() {
        $(this).siblings('input[type="file"]').click();
    });


    
@endsection

@section('custom_window_width_script')

    //$('.article.segment').removeClass('w-50');

@endsection

@section('custom_resize_if_script')

    //$('.article.segment').addClass('w-50');

@endsection

@section('custom_resize_else_script')

    //$('.article.segment').removeClass('w-50');

@endsection

