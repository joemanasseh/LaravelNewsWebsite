{{ request()->session()->put('["RF"]["subfolder"]', 'authors/' . Auth::user()->username) }}

@extends('templates.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
@endsection

@section('title', 'IABC Africa - ' . titleCase($article->title))

@section('content')

    <div class="ui container mt-20">
        
        <div class="ui grid">
            <!-- <div class="ui ten wide centered blue column"></div> -->
            <div class="fourteen wide computer sixteen wide mobile centered column post_show_main">
                @if(count($errors) > 0)
                <div class="ui error message mb-50">
                    <i class="ui close icon"></i>
                    <div class="centered header">Article Update Failed</div>
                    <ul class="list">
                        @foreach($errors->all() as $input_error)
                        <li>{{ $input_error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <a href="{{ route('topic.articles', slug($article->topic->name)) }}" class="ui blue text text-bold uppercase">{{ $article->topic->name }}</a>
                <div class="ui large header mt-0">
                    <div class="ui large header mt-0">
                        {{ titleCase($article->title) }}
                    </div>
                    <div class="sub header text-italic">{{ $article->description }}</div>
                </div>
                <div class="ui divider"></div>
                <!--  -->
                <div class="ui stackable grid">
                    <div class="twelve wide column">
                        <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}" alt="" class="ui fluid image">
                        <div class="ui right floated tiny header text-italic">{{ !empty($article->image_credit) ? 'Image Credit: '.$article->image_credit : '' }}</div>
                        <!--  -->
                        <div class="ui text text-justify text post-body article mt-50" data-imgurl="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/body') }}">
                            {!! $article->body !!}
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui segment">
                            <div class="ui header">
                                <div class="ui orange dividing header mb-10">Written By:</div>
                                <div class="content w-100">
                                    <img src="{{ asset('img/users/' . $article->user->photo) }}" alt="" class="ui image avatar right floated">
                                    <a href="{{ route('profiles.author', slug($article->user->username)) }}">
                                        {{ $article->user->lastname.' '.$article->user->firstname  }}
                                    </a>
                                    <div class="sub header text-bold ">{{ $article->user->author }}</div>
                                </div>
                                <!--  -->
                                <div class="ui orange dividing header mb-10 mt-10">Date:</div>
                                <div class="content">
                                    Created
                                    <div class="sub header text-bold mb-5">{{ date('jS F, o', strtotime($article->created_at)) }}</div>
                                    <!-- Published -->
                                    <!-- <div class="sub header text-bold mb-5">{{ date('jS F, o', strtotime($article->updated_at)) }}</div> -->
                                    @if($article->updated_at)
                                    Last Edit
                                    <div class="sub header text-bold mb-5">
                                        @if($article->updated_at == $article->created_at)
                                           Never
                                        @else
                                            {{ ucwords(timeago($article->updated_at)) }}
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <!--  -->
                                <div class="ui orange dividing header">Meta:</div>
                                <div class="content">
                                    <div class="ui list">
                                        <div class="item">
                                            <i class="large eye icon"></i>
                                            <div class="middle aligned content">
                                                <div class="small header d-inline">{{ $article->view_count }}</div>
                                                <div class="sub header d-inline"> Views</div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="large thumbs up icon"></i>
                                            <div class="middle aligned content">
                                                <div class="small header d-inline">? </div>
                                                <div class="sub header d-inline"> Likes</div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="large comments icon"></i>
                                            <div class="middle aligned content">
                                                <div class="small header d-inline">? </div>
                                                <div class="sub header d-inline"> Comments</div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="large share alternate icon"></i>
                                            <div class="middle aligned content">
                                                <div class="small header d-inline">? </div>
                                                <div class="sub header d-inline"> Shares</div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="large folder plus icon"></i>
                                            <div class="middle aligned content">
                                                <div class="small header d-inline">{{ $savecount }}</div>
                                                <div class="sub header d-inline"> Saves</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="ui orange dividing header mb-10">Action:</div>
                                <div class="content">
                                    <div class="ui grid">
                                        @if(Auth::user()->author == 'Editor')
                                        <div class="ui sixteen wide column pb-0">
                                            <label for="" class="d-block">Status</label>
                                            <div class="ui editor_status selection dropdown mt-5 fluid" data-status="{{ $article->editor_status }}">
                                                <input name="status" type="hidden">
                                                <i class="dropdown icon"></i>
                                                <div class="default text">Select Status</div>
                                                <div class="menu">
                                                    <div class="item" data-value="pending">
                                                        <i class="sync alternate icon"></i>
                                                        Pending
                                                    </div>
                                                    <div class="item" data-value="published">
                                                        <i class="green check mark icon"></i>
                                                        Published
                                                    </div>
                                                    <div class="item" data-value="rejected">
                                                        <i class="red times icon"></i>
                                                        Rejected
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="ui fluid orange update_status hidden button">
                                                Update Status
                                            </button>
                                            <form class="ui form" id="update_status_form" method="POST" action="{{ route('articles.update', slug($article->title)) }}">
                                                @csrf
                                                {!! method_field('PUT') !!}
                                                <div class="hidden field">
                                                    <input id="editor_status" type="text" name="editor_status" id="" value="">
                                                </div>
                                            </form>
                                        </div>
                                                
                                        
                                        <div class="ui eight wide column">
                                            <div class="ui fluid blue edit_article_button button">Edit</div>
                                        </div>
                                        <div class="ui tiny edit_article_modal modal">
                                            <i class="close icon"></i>
                                            <div class="header">Edit Article</div>
                                            <div class="scrolling content">

                                                <div class="ui fluid segment">
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
                                                    <form class="ui large form" id="update_article_form" method="POST" action="{{ route('articles.update', slug($article->title)) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        {!! method_field('PUT') !!}
                                                        <input type="text" name="user" id="" value="{{ $article->user->id }}" hidden>
                                                        <div class="ui two fields">
                                                            <div class="ui fluid field @if ($errors->has('topic_subtopics')) error @endif">
                                                                <label>Topic</label>
                                                                <div class="ui search selection dropdown article_topic">
                                                                    <input name="topic" type="hidden" data-topic="{{ $article->topic->id }}">
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
                                                            <div class="ui field @if ($errors->has('topic_subtopics')) error @endif">
                                                                <label>Subtopic</label>
                                                                <div class="ui search selection dropdown article_subtopic">
                                                                    <input name="subtopic" type="hidden" data-subtopic="{{ $article->subtopic->id }}">
                                                                    <i class="dropdown icon"></i>
                                                                    <div class="default text">Select Subtopic</div>
                                                                    <div class="menu topic_subtopic">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="field @if($errors->has('image')) error @endif">
                                                            <label for="">Featured Image</label>
                                                            <div class="form-group">
                                                                <div class="fileinput w-100 mb-0 fileinput-exists" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail w-100 ui rounded field-border">
                                                                        <img src="http://iabc.com/img/ui/placeholder-image.png" class="img-fluid" alt="...">
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail lh-0" style="">
                                                                        <img src="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/featured/' . $article->image) }}">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn-default btn-file">
                                                                            <span class="fileinput-new ui button file-click left floated">Select Image</span>
                                                                            <span class="fileinput-exists ui button file-click left floated">Change</span>
                                                                            <input type="hidden" value=""><input type="file">
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
                                                            <input type="text" name="image_credit" placeholder="Image Credit" value="{{ $article->image_credit }}">
                                                        </div>
                                                        <div class="field @if ($errors->has('title')) error @endif">
                                                            <label>Title</label>
                                                            <input type="text" name="title" placeholder="Title" value="{{ titleCase($article->title) }}">
                                                        </div>
                                                        <div class="field @if ($errors->has('description')) error @endif">
                                                            <label>Description</label>
                                                            <input type="text" name="description" placeholder="Description" value="{{ $article->description }}">
                                                        </div>

                                                        <div class="field @if ($errors->has('body')) error @endif w-100">
                                                            <label>Body</label>
                                                            <textarea name="body" id="editor" class="post-body" data-imgurl="{{ asset('img/articles/' . sprintf('%06d', $article->id) . '-' . slug($article->title) . '/body') }}">
                                                                {!! $article->body !!}
                                                            </textarea>
                                                        </div>

                                                        <div class="hidden field">
                                                            <label>BodyImages</label>
                                                            <textarea name="bodyimage" id="bodyimage"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="ui orange approve button">Submit Changes</div>
                                                <div class="ui cancel red button">Ignore Changes</div>
                                            </div>
                                        </div>
                                        <div class="ui eight wide column">
                                            <div class="ui fluid red button delete_article_button">Delete</div>
                                        </div>
                                        @elseif(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                        <div class="ui sixteen wide column">
                                            <div class="ui fluid red button delete_article_button">Delete</div>
                                        </div>
                                        @endif
                                        <div class="ui mini delete_article_modal modal">
                                            <i class="close icon"></i>
                                            <div class="header">Delete Article</div>
                                            <div class="content">
                                                <div class="ui text">Are you sure you want to delete this article?</div>
                                            </div>
                                            <div class="actions">
                                                <div class="ui approve green button">Yes, Delete</div>
                                                <div class="ui cancel red button">No, Cancel</div>
                                            </div>
                                        </div>
                                        <form id="delete_article_form" class="{{ $article->id }}" action="{{route('articles.destroy', slug($article->title))}}" method="post">
                                            @csrf
                                            {!! method_field('DELETE') !!}
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="ui large dividing header">RELATED ARTICLES</div>
                        <div class="ui divided list">
                        @if(count($topicarticles) != 0)
                        @foreach($topicarticles as $topicarticle)
                            <div class="ui item">
                                <div class="content mt-10">
                                    <a href="{{ route('topic.articles', slug($topicarticle->topic->name)) }}" class="ui tiny blue text">{{ strtoupper($topicarticle->topic->name) }}</a>
                                    <a href="{{ route('articles.read', $topicarticle->id) }}">
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
                                            {{ round(str_word_count($topicarticle->body) / 250) }} mins read
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
                <div class="ui fluid bordered image my-50">
                    <img src="{{ asset('img/bg/ad_placeholder.png') }}" alt="">
                </div>
                <!--  -->
                
            </div>
        </div>
    </div>

    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce/jquery.tinymce.min.js') }}"></script>

    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>


@endsection


@section('custom_script')

    $('.file-click').click(function() {
        $(this).siblings('input[type="file"]').attr('name', 'image').click();
    });

    $('.editor_status').dropdown('set selected', $('.editor_status.dropdown').attr('data-status'));

    $('.editor_status').find('.item').not('.active.selected').click(function() {
        var editorstatus = $(this).attr('data-value');
        $('#update_status_form').find('input#editor_status').attr('value', editorstatus);
        $('.update_status.button').removeClass('hidden');
    });

    $('.editor_status').find('.item.active.selected').click(function() {
        $('#update_status_form').find('input#editor_status').val('');
        $('.update_status.button').addClass('hidden');
    });

    $('.update_status.button').click(function() {
        $(this).addClass('loading');
        $('.edit_article_button, .delete_article_button').addClass('disabled');
        $('#update_status_form').submit();
    });

    var imgurl = $('.post-body').attr('data-imgurl');
    $('.post-body').find('img').each(function() {
        var imgsrc = $(this).attr('src').split('/');
        var imgname = imgsrc[imgsrc.length - 1];
        $(this).attr('src', imgurl + '/' + imgname);
    });

    
    
    $('.edit_article_button').click(function() {
        var editor_config = {
            path_absolute : "{{ URL::to('/') }}/",
            selector: "textarea#editor",
            //height: tinyheight - 23,
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
                    var imgurl = $('.edit_article_modal').find('.post-body').attr('data-imgurl');
                    
                    $(editor.getBody()).find('img').each(function() {
                        var imgsrc = $(this).attr('src').split('/');
                        var imgname = imgsrc[imgsrc.length - 1];
                        $(this).attr('src', imgurl + '/' + imgname);
                    });

                });
            }

        };
        $('.edit_article_modal').modal('setting', {
            autofocus: false,
            onVisible: function() {
                tinymce.init(editor_config);
                
            },
            onApprove : function(editor){
                $(this).find('.ui.approve.button').addClass('loading disabled').parent()
                .parent().find('.cancel').addClass('disabled');

                $(tinymce.activeEditor.getBody()).find('img').each(function() {
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
                
                $('#update_article_form').submit();
                return false;
            }
        }).modal('show');

        var article_topic = $('input[name="topic"]').attr('data-topic');
        $('.article_topic').dropdown('set selected', article_topic);

        $('.topic_subtopic.menu').empty();
        $('.article_subtopic.dropdown').dropdown('clear');
        $('.edit_article_modal').find('.topic.item.selected').children('.subtopic.temp_item').clone().addClass('item').removeClass('hidden').appendTo('.topic_subtopic.menu');

        setTimeout(function() {
            var article_subtopic = $('input[name="subtopic"]').attr('data-subtopic');
            $('.article_subtopic').dropdown('set selected', article_subtopic);
        }, 0);


    });


    $('.topic.item').click(function() {

        $('.topic_subtopic.menu').empty();
        $('.article_subtopic.dropdown').dropdown('clear');
        $(this).children('.subtopic').clone().addClass('item').removeClass('hidden').appendTo('.topic_subtopic.menu');
        //$('.subtopic.dropdown').removeClass('disabled').find('.default.text').text('Select Subtopic');

    });



    $('.delete_article_button').click(function(e) {
        e.preventDefault();
        $('.delete_article_modal').modal('show')
        .find('.ui.approve.button').click(function() {
            $('.delete_article_button').addClass('loading');
            $('#delete_article_form').submit();
        });
        
    });


@endsection