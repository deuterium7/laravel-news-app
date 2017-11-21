<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Tests\Catalog;
use Tests\TestCase;
use Tests\UserStub;

class CommentControllerTest extends TestCase
{
    use UserStub, Catalog;

    /** @test */
    public function user_can_create_comment()
    {
        $user = $this->createUserStub();
        $article = Article::first();

        $this->be($user);
        $this->get("articles/$article->id")
            ->assertStatus(200);

        $request = [
            'user_id'    => $user->id,
            'article_id' => $article->id,
            'body'       => 'Can create comment',
            '_token'     => csrf_token(),
        ];

        $this->post('comments', $request)
            ->assertStatus(302);
        $comment = $this->latest(Comment::class);

        $this->assertEquals('Can create comment', $comment->body);
    }

    /** @test */
    public function user_can_update_comment()
    {
        $user = $this->latest(User::class);
        $comment = $this->latest(Comment::class);

        $this->be($user);
        $this->get("comments/$comment->id/edit")
            ->assertStatus(200);

        $request = [
            'body'   => 'Can update comment',
            '_token' => csrf_token(),
        ];

        $this->put("comments/$comment->id", $request)
            ->assertStatus(302);

        $commentUpdate = $this->latest(Comment::class);

        $this->assertNotEquals($comment, $commentUpdate);
    }

    /** @test */
    public function admin_can_delete_comment()
    {
        $user = $this->latest(User::class);
        $admin = $this->createUserStub('admin');
        $commentDelete = $this->latest(Comment::class);

        $this->be($admin);
        $this->get('admin/comments')
            ->assertStatus(200);

        $this->delete("comments/$commentDelete->id", ['_token' => csrf_token()])
        ->assertStatus(302);

        $commentOld = $this->latest(Comment::class);

        $this->assertNotEquals($commentDelete, $commentOld);

        $user->delete();
        $admin->delete();
    }
}
