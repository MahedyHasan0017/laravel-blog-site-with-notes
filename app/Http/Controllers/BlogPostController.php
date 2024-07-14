<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogPostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only(['post_create', 'post_update', 'post_delete_store']);
    }


    public function home()
    {

        // $posts = BlogPost::all();

        $posts = BlogPost::latest()->withCount('comments')->get();
        $most_commenteds = BlogPost::mostCommented()->skip(1)->take(3)->get() ; 
        $most_popular = BlogPost::mostCommented()->take(1)->first() ; 
        $most_active_authors = User::withMostBlogPost()->take(5)->get() ; 
        $most_active_authors_in_last_month = User::withMostBlogPostsInLastMonth()->take(5)->get() ; 
        // dd($most_active_authors) ; 
        // dd($most_popular) ; 
        //these will create a extra column named comments_count 

        return view('home.home', [
            'posts' => $posts,
            'most_commenteds' => $most_commenteds ,
            'most_popular' => $most_popular ,
            'most_active_authors' => $most_active_authors,
            'most_active_authors_in_last_month' => $most_active_authors_in_last_month
        ]);
    }

    public function post($id)
    {

        // $post = BlogPost::with(['comments' => function($query){
        //     return $query->latest() ; 
        // }])->findOrFail($id);

        $post = BlogPost::with('comments')->findOrFail($id);

        return view('posts.single-post', [
            'post' => $post
        ]);
    }


    public function post_create()
    {

        // return "hello" ; 
        return view('posts.create');
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

        $validated += ["user_id" => Auth::user()->id] ; 

        $post = BlogPost::create($validated);
     
        if ($post) {
            toastr()->success('Post Created Successfully!');
            return redirect()->route('single.post', ['id' => $post->id]);
        } else {
            toastr()->error('Something Went Wrong!');
            return redirect()->back();
        }


        // Display a success toast with no title
        // flash()->success('Operation completed successfully.');

        // toastr()->success('Post Created successfully!');

        // toastr()->error('An error has occurred please try again later.');

        // return redirect()->route('single.post',['id' => $post->id]) ; 

    }


    public function post_update($id)
    {

        // return "hello" ; 

        $post = BlogPost::findOrFail($id);


        // if (Gate::denies('update-post', $post)) {
        //     abort(403,'This is abort message : you cannot update others authors posts');
        // }

        // $this->authorize('posts.update',$post) ; 

        $this->authorize('update',$post) ; 


        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function post_update_store(StorePost $request, $id)
    {




        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403,'This is abort message : you cannot update others authors posts');
        // }

        $this->authorize('update',$post) ; 

        $validated = $request->validated();
        $post->fill($validated);
        $done = $post->save();


        if ($done) {
            toastr()->success('Post Updated Successfully!');
            return redirect()->route('single.post', ['id' => $post->id]);
        } else {
            toastr()->error('Something Went Wrong!');
            return redirect()->back();
        }
    }


    public function post_delete_store(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);


        // if (Gate::denies('delete-post', $post)) {
        //     abort(403,'This is abort message : you cannot delete others authors posts');
        // }

        // $this->authorize('posts.delete',$post) ; 
        $this->authorize('delete',$post) ; 

        $done = $post->delete();

        if ($done) {
            toastr()->success('Post Deleted Successfully!');
            return redirect()->route('home');
        } else {
            toastr()->error('Something Went Wrong!');
            return redirect()->back();
        }
    }
}
