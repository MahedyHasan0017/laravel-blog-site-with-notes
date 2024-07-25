<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $me = DB::table('users')->insert(
            [
                'name' => "mhdy",
                'email' => "mhdy@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('11111111'), // password
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]
        );

        $ajax = DB::table('users')->insert(
            [
                'name' => "ajax",
                'email' => "ajax@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('11111111'), // password
                'remember_token' => Str::random(10),
                'is_admin' => false
            ]
        );

        $others = User::factory()->count(20)->create();

        $users = $others->concat([$me , $ajax]);


        $posts = BlogPost::factory()->count(40)->make()->each(function ($post) use ($users) {
            $post->user_id = User::all()->random()->id;
            $post->save();
        });


        $users = User::all();

        $comments = Comment::factory()->count(140)->make()->each(function ($comment) use ($posts, $users) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        // $tags = Tags::factory()->count(150)->
        $tags = collect(['Science', 'Sports', 'Politics', 'Economy', 'Entertainment']);
        $tags->each(function ($tagName) {
            $tag = new Tags();
            $tag->name = $tagName;
            $tag->save();
        });

        $tagCount = Tags::all()->count();

        BlogPost::all()->each(function (BlogPost $post) use ($tagCount) {
            $take = random_int(0, $tagCount);
            $tags = Tags::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
