<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes ; 

    public $timestamps = true;


    protected $fillable = [
        'title',
        'content',
        'user_id' 
    ];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class) ; 
    }

    public static function boot(){
        parent::boot() ; 

        //this method will run before blogPost model instance post deleted
        // at first it will delete comments then it will delete post 
        static::deleting(function(BlogPost $blogPost){
            $blogPost->comments()->delete() ; 
        });
    }


}
