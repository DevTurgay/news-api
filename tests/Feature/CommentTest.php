<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function all_comments_of_a_news_can_be_fetched()
    {
        $id = 1;
        $response = $this->get('/news-comments' . $id);
        $response->assertStatus(200);
    }

    public function a_comment_can_be_created()
    {
        $comment = [
            "content" => "Comment test content",
            "author_name" => "Comment test author"
        ];
        $response = $this->post('/news-comments', $comment);
        $response->assertStatus(200);
    }

    public function a_comment_can_be_updated()
    {
        $id = 1;
        $comment = [
            "content" => "Comment test content - UPDATED",
            "author_name" => "Comment test author - UPDATED"
        ];
        $response = $this->post('/news-comments' . $id, $comment);
        $response->assertStatus(200);
    }

    /**
     *
     */
    public function a_comment_can_be_deleted()
    {
        $id = 1;
        $response = $this->get('/news-comments/destroy' . $id);
        $response->assertStatus(200);
    }
}
