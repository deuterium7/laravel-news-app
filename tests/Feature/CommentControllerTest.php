<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use WithoutEvents;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var User
     */
    protected $admin;

    /**
     * @var int
     */
    protected $articleId;

    /**
     * Базовые значения для теста.
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);

        $this->admin = factory(User::class)->make(['admin' => true]);
        $this->articleId = Article::first()->id;
    }

    /** @test */
    public function the_user_can_create_comment()
    {
        $this->get("articles/$this->articleId")
            ->assertStatus(200);

        $request = [
            'user_id'    => $this->user->id,
            'article_id' => $this->articleId,
            'body'       => 'Can create comment',
            '_token'     => csrf_token(),
        ];

        $this->post('comments', $request)
            ->assertStatus(302);
        $comment = Comment::latest()->first();

        $this->assertEquals('Can create comment', $comment->body);
    }

    /** @test */
    public function the_user_can_update_comment()
    {
        $comment = Comment::latest()->first();

        $request = [
            'body'   => 'Can update comment',
            '_token' => csrf_token(),
        ];

        $comment->update($request);

        $commentUpdate = Comment::latest()->first();

        $this->assertNotEquals($comment, $commentUpdate);
    }

    /** @test */
    public function the_admin_can_delete_comment()
    {
        $commentDelete = Comment::latest()->first();

        $this->actingAs($this->admin);
        $this->get('admin/comments')
            ->assertStatus(200);

        $this->delete("comments/$commentDelete->id", ['_token' => csrf_token()])
            ->assertStatus(302);

        $commentOld = Comment::latest()->first();

        $this->assertNotEquals($commentDelete, $commentOld);

        $this->user->delete();
    }
}
