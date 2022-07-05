<?php

namespace Tests\Feature;

use App\Models\News;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * Test if a news can be created
     *
     * @return void
     */
    public function test_a_news_can_be_created()
    {
        $news = [
            "title"  => "Test news title",
            "authorName" => "Test news author name"
        ];
        $response = $this->post('/api/news', $news);
        $response->assertStatus(201);
    }

    /**
     * A news can be updated
     *
     * @return void
     */
    public function test_a_news_can_be_updated()
    {
        $id = News::max('id');
        $news = [
            "title"  => "Test news title UPDATED",
            "authorName" => "Test news author name UPDATED"
        ];
        $response = $this->put('/api/news/' . $id, $news);
        $response->assertStatus(200);
    }

    /**
     * A single news can be fetched
     *
     * @return void
     */
    public function test_a_news_can_be_fetched()
    {
        $id = News::max('id');
        $response = $this->get('/api/news/' . $id);
        $response->assertStatus(200);
    }

    /**
     * All news can be fetched
     *
     * @return void
     */
    public function test_all_news_can_be_fetched()
    {
        $response = $this->get('/api/news');
        $response->assertStatus(200);
    }

    /**
     * A news can be upvoted
     *
     * @return void
     */
    public function test_a_news_can_be_upvoted()
    {
        $id = News::max('id');
        $response = $this->get('/api/news/upvote/' . $id);
        $response->assertStatus(202);
    }
}
