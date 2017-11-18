<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use Tests\TestCase;
use Tests\UserStub;

class CommentViewsTest extends TestCase
{
    use UserStub;

    /** @test */
    public function can_show_comment_edit_view()
    {
        $article = Article::first();
        $user = $this->createUserStub();
        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id'    => $user->id,
            'body'       => 'edit view test',
        ]);

        $this->actingAs($user)
            ->get("comments/$comment->id/edit")
            ->assertStatus(200)
            ->assertViewIs('comments.edit')
            ->assertViewHas('comment')
            ->assertSee(trans('catalog.update'));

        $comment->delete();
        $user->delete();
    }
}
