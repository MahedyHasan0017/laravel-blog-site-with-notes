<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {

        $done = $post->comments()->create([
            'content' => $request->content ,
            'user_id' => $request->user()->id , 
            'blog_post_id' => $post->id 
        ]) ; 


        if ($done) {
            toastr()->success('Comment Created Successfully!');
            return redirect()->back();
        } else {
            toastr()->error('Something Went Wrong!');
            return redirect()->back();
        }


    }
}
