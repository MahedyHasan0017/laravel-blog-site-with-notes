<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

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
        return $this->hasMany(Comment::class)->latest();
    }

    public function user(){
        return $this->belongsTo(User::class) ; 
    }

    public function tags(){
        return $this->belongsToMany(Tags::class)->withTimestamps() ; 
    }

    public function image(){
        return $this->morphOne(Image::class , 'imageable') ; 
    }


    //its using method name will be latest() in controller 
    public function scopeLatest(Builder $query){
        return $query->orderBy('created_at','desc') ; 
    }


    //mostCommented 
    public function scopeMostCommented(Builder $query){


        //comments count will generate a field named "comments_count" 

        return $query->withCount('comments')->with('user')->orderBy('comments_count','desc') ; 
    }


    public function scopeLatestWithRelations(Builder $query){
        return $query->latest()->withCount('comments')->with('user')->with('tags');
    }


    public static function boot(){
        parent::boot() ; 


        static::addGlobalScope(new LatestScope) ; 

        //this method will run before blogPost model instance post deleted
        // at first it will delete comments then it will delete post 
        static::deleting(function(BlogPost $blogPost){
            $blogPost->comments()->delete() ; 
        });


        static::updating(function(BlogPost $blogPost){
            Cache::forget('blog-post-{$blogPost->id}') ; 
        });

    }


}
