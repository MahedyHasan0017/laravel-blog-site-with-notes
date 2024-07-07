<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
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

        return view('posts.single-post', [
            'post' => $post
        ]);
    }


    public function post_create()
    {

        // return "hello" ; 
        return view('posts.create') ; 
    }

    public function post_create_store(StorePost $request)
    {
        // dd($request->all()) ; 

        $validated = $request->validated(); // validated data will returned as array


        // $post = new BlogPost() ; 
        // $post->title = $validated['title'] ; 
        // $post->content = $validated['content'] ; 
        // $post->save() ; 



        // after mass assignment 

        $post = BlogPost::create($validated) ; 

        if($post){
            toastr()->success('Post Created Successfully!');
            return redirect()->route('single.post',['id' => $post->id]) ; 
        }
        else{
            toastr()->error('Something Went Wrong!');
            return redirect()->back() ; 
        }


        // Display a success toast with no title
        // flash()->success('Operation completed successfully.');

        // toastr()->success('Post Created successfully!');

        // toastr()->error('An error has occurred please try again later.');

        // return redirect()->route('single.post',['id' => $post->id]) ; 

    }


}
