<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function a_news_can_be_created()
    {
        $news = [
            "title"  => "Test news title",
            "author_name" => "Test news author name"
        ];
        $response = $this->post('/news', $news);
        $response->assertStatus(200);
        // $createdId = Leagues::max('id');
        // $this->assertEquals($nextId, $createdId);
    }

    public function a_news_can_be_updated()
    {
        $id = 1;
        $news = [
            "title"  => "Test news title UPDATED",
            "author_name" => "Test news author name UPDATED"
        ];
        $response = $this->put('/news' . $id, $news);
        $response->assertStatus(200);
        // $createdId = Leagues::max('id');
        // $this->assertEquals($nextId, $createdId);
    }

    public function a_news_can_be_fetched()
    {
        $id = 1;
        $response = $this->get('/news' . $id);
        $response->assertStatus(200);
        // $createdId = Leagues::max('id');
        // $this->assertEquals($nextId, $createdId);
    }

    public function all_news_can_be_fetched()
    {
        $response = $this->get('/news');
        $response->assertStatus(200);
    }

    public function a_news_can_be_upvoted()
    {
        $id = 1;
        $response = $this->get('/news-upvote' . $id);
        $response->assertStatus(200);
    }
}
