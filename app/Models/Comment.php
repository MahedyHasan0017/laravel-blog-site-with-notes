<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    // $table->unsignedBigInteger('blog_post_id') ; 
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    // if 
    // $table->unsignedBigInteger('post_id') ; 
    // public function post()
    // {
    //     return $this->belongsTo(BlogPost::class);
    // }


    //its using method name will be latest() in controller 
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('created_at', 'desc');
    }



    public static function boot()
    {
        parent::boot();
        // static::addGlobalScope(new LatestScope) ; 
    }
}
