<?php

namespace App\Models;

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
}
