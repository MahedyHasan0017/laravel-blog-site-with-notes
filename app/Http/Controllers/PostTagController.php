<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostTagController extends Controller
{
    public function index($tag){

        $tag = Tags::findOrFail($tag);
        $posts = $tag->blogPosts()->latestWithRelations()->get() ; 

        $most_commenteds = Cache::remember('blog-post-commented', now()->addSeconds(5), function () {
            // return BlogPost::mostCommented()->skip(1)->take(3)->get() ; 
            return BlogPost::mostCommented()->skip(1)->take(3)->get();
        });

        $most_popular = Cache::remember('users-most-active', now()->addSeconds(20), function () {
            return BlogPost::mostCommented()->take(1)->first();
        });

        $most_active_authors = Cache::remember('users-most-active-authors', now()->addSeconds(20), function () {
            return User::withMostBlogPost()->take(5)->get();
        });

        $most_active_authors_in_last_month = Cache::remember('users-most-active-last-month', now()->addSeconds(20), function () {
            return User::withMostBlogPostsInLastMonth()->take(5)->get();
        });




        return view('home.home',[
            'posts' => $posts,
            'most_commenteds' => $most_commenteds,
            'most_popular' => $most_popular,
            'most_active_authors' => $most_active_authors,
            'most_active_authors_in_last_month' => $most_active_authors_in_last_month
        ]);
    }
}
