<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only(['post_create', 'post_update', 'post_delete_store']);
    }


    public function home()
    {

        // $posts = BlogPost::all(); 



        $posts = BlogPost::latestWithRelations()->get();

        // $posts = BlogPost::latest()->withCount('comments')->with('user')->with('tags')->get();
        // $most_commenteds = BlogPost::mostCommented()->skip(1)->take(3)->get() ; 
        // $most_popular = BlogPost::mostCommented()->take(1)->first() ; 
        // $most_active_authors = User::withMostBlogPost()->take(5)->get();
        // $most_active_authors_in_last_month = User::withMostBlogPostsInLastMonth()->take(5)->get();
        // dd($most_active_authors) ; 
        // dd($most_popular) ; 
        //these will create a extra column named comments_count 

        return view('home.home', [
            'posts' => $posts,
        ]);
    }

    public function single_post($id)
    {

        // $post = BlogPost::with(['comments' => function($query){
        //     return $query->latest() ; 
        // }])->findOrFail($id);

        // $post = BlogPost::with('comments')->findOrFail($id);


        // $post = Cache::remember('blog-post-{$id}', 60, function () use ($id) {
        //     return BlogPost::with('comments')->with('user')->findOrFail($id);
        // });

        $post =  BlogPost::with('comments')->with('tags')->with('user')->with('comments.user')->findOrFail($id);

        // $post =  BlogPost::with(['comments','tags','user','comments.user'])->findOrFail($id);

        $sessionId = session()->getId();
        $counterKey = 'blog-post-{$id}-counter';
        $usersKey = 'blog-post-{$id}-users';

        $users = Cache::get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference -= 1;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference += 1;
        }

        $usersUpdate[$sessionId] = $now;

        Cache::forever($usersKey, $usersUpdate);

        if (!Cache::has($counterKey)) {
            Cache::forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $difference);
        }


        $counter = Cache::get($counterKey);

        return view('posts.single-post', [
            'post' => $post,
            'counter' => $counter
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

        $validated += ["user_id" => Auth::user()->id];

        $post = BlogPost::create($validated);


        if ($post) {


            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $link = $file->store('public/thumbnails');
                $path = str_replace('public', 'storage', $link);
                $post->image()->save(
                    Image::create([
                        'path' => $path,
                        'blog_post_id' => $post->id
                    ])
                );
            }
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

        $this->authorize('update', $post);


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

        $this->authorize('update', $post);

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
        $this->authorize('delete', $post);

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
