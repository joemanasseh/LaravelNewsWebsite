<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Topic;
use App\Sidebar;

class PostController extends Controller
{
    //
    public function getIndex() {
        $artic = Post::orderBy('id', 'desc')->paginate(5);
        return view('blog.index')->withPosts($posts);
    }
    
    public function read($id) {
        $post = Article::find($id);
        $activesidebars = Sidebar::orderBy('id', 'asc')->where('status','active')->get();
        $activetopics = Topic::orderBy('id', 'asc')->where([['status','active'],['sidebar','visible']])->get();
        return view('pages.post_view')->withPost($post)->withActivesidebars($activesidebars)
                                                        ->withActivetopics($activetopics);
    }
}
