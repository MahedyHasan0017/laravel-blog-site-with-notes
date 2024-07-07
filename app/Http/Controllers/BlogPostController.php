<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function home()
    {

        $posts = BlogPost::all();

        return view('home.home', [
            'posts' => $posts
        ]);
    }

    public function post($id)
    {

        $post = BlogPost::findOrFail($id);

        return view('post.single-post', [
            'post' => $post
        ]);
    }
}
