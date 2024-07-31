<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Illuminate\Contracts\Database\Query\Builder;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function blogPost()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }



    //User model targeting blog_posts table with blogPost() method and withcount will generate a field named blog_post_count 
    // we will sort it in decending order respect to blog_post_count field  


    public function scopeWithMostBlogPost(Builder $query)
    {
        return $query->withCount('blogPost')->orderBy('blog_post_count', 'desc');
    }

    public function scopeWithMostBlogPostsInLastMonth(Builder $query)
    {
        return $query->withCount(['blogPost' => function (Builder $query) {
            $query->whereBetween('created_at', [now()->subMonth(1), now()]);
        }])->having('blog_post_count', '>=',  2)->orderBy('blog_post_count', 'desc');
    }
}
