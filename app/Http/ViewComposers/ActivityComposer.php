<?php

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{
    public function compose(View $view)
    {
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

        $view->with('most_commenteds',$most_commenteds) ; 
        $view->with('most_popular',$most_popular) ; 
        $view->with('most_active_authors',$most_active_authors) ; 
        $view->with('most_active_authors_in_last_month',$most_active_authors_in_last_month) ; 

    }
}
