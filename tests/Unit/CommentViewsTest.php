<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class CommentViewsTest extends TestCase
{
    use WithoutEvents;

    /** @test */
    public function the_user_can_see_own_comment_edit_form()
    {
        $articleId = Article::first()->id;
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create([
            'article_id' => $articleId,
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get("comments/$comment->id/edit")
            ->assertStatus(200)
            ->assertSee(trans('catalog.update'));

        $user->delete();
    }
}
