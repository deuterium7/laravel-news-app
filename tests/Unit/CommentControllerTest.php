<?php

namespace Tests\Unit;

use App\Models\Comment;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_can_create_comment()
    {
        $comment = new Comment();
        $this->assertInstanceOf(Comment::class, $comment);
    }

    public function test_comment_store()
    {
        $request = [];
        $response = $this->call('POST', 'comments', $request);
        $this->assertEquals(302, $response->status());
    }

    public function test_comment_destroy()
    {
        $response = $this->call('DELETE', 'comments/1');
        $this->assertEquals(302, $response->status());
    }
}
