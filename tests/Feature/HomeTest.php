<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
   
    // public function test_example(): void
    // {
    //     $response = $this->get('/home');
    //     $response->assertSeeText('Mhdy');
    //     // $response->assertStatus(200);
    // }

    public function testHomePageIsWorkingCorrectly(){
        $response = $this->get('/home') ; 
        $response->assertSeeText('Mhdy') ; 
    }


    // public function testPostDetailsPageWorkingCorrectly(){
    //     $response = $this->get('single/post/1') ; 
    //     $response->assertSeeText("title-1") ; 
    // }


}
