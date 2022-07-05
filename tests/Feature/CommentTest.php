<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A comment can be created
     *
     * @return void
     */
    public function test_a_comment_can_be_created()
    {
        $newsId = News::max('id');
        $comment = [
            "content" => "Comment test content",
            "authorName" => "Comment test author",
            "newsId" => $newsId
        ];
        $response = $this->post('/api/comment', $comment);
        $response->assertStatus(201);
    }

    /**
     * All comments can be fetched
     *
     * @return void
     */
    public function test_all_comments_of_a_news_can_be_fetched()
    {
        $newsId = News::max('id');
        $response = $this->get('/api/comment/by-news/' . $newsId);
        $response->assertStatus(200);
    }

    /**
     * Single comment can be fetched
     *
     * @return void
     */
    public function test_single_comment_can_be_fetched()
    {
        $id = Comment::max('id');
        $response = $this->get('/api/comment/' . $id);
        $response->assertStatus(200);
    }

    /**
     * A comment can be updated
     *
     * @return void
     */
    public function test_a_comment_can_be_updated()
    {
        $id = Comment::max('id');
        $comment = [
            "content" => "Comment test content - UPDATED",
            "authorName" => "Comment test author - UPDATED"
        ];
        $response = $this->put('/api/comment/' . $id, $comment);
        $response->assertStatus(200);
    }

    /**
     * A comment can be deleted
     *
     * @return void
     */
    public function test_a_comment_can_be_deleted()
    {
        $id = Comment::max('id');
        $response = $this->delete('/api/comment/' . $id);
        $response->assertStatus(200);
    }
}
