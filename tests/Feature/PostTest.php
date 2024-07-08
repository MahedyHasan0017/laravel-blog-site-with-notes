<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;



    public function testCreatePost10()
    {

        //Arrange 

        $post = new BlogPost();
        $post->title = "title-1";
        $post->content = 'content-1';
        $post->save();

        //Act 
        $response = $this->get('/home');
        $response->assertSeeText('title-1');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'title-1'
        ]);
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'title-22',
            'content' => 'content-22'
        ];

        $this->post('/post/create/store', $params)
            ->assertStatus(302);
        // ->assertSessionHasStatus()
    }

    public function testStoreFail()
    {
        // $params = [
        //     'title' => "title - 3", 
        //     'content' => 'content - 3'
        // ];

        $params = [
            'title' => "",
            'content' => ''
        ];

        $this->post('/post/create/store', $params)
            ->assertStatus(302)
            ->assertSessionHasErrors();

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], "The title field is required.");
        $this->assertEquals($messages['content'][0], "The content field is required.");
        // dd($messages->getMessages()) ; 

    }

    public function testUpdateValid()
    {

        $post = new BlogPost();
        $post->title = "title-1";
        $post->content = 'content-1';
        $post->save();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $params = [
            'title' => "xxxx",
            'content' => 'xxxxxx'
        ];

        $this->put('post/update/3/store', $params)
            ->assertStatus(302);

        // $this->assertEquals()
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => "xxxx",
            'content' => 'xxxxxx'
        ]);
    }

    public function testDeletingIsOk()
    {
        $post = $this->creatingDummyBlogPost();
        $this->assertDatabaseHas('blog_posts' , $post->toArray()) ; 
        $this->delete('post/delete/4')->assertStatus(302);
        $this->assertDatabaseMissing('blog_posts',$post->toArray()) ; 
    }

    private function creatingDummyBlogPost()
    {
        $post = new BlogPost();
        $post->title = "title-1";
        $post->content = 'content-1';
        $post->save();
        return $post;
    }
}
