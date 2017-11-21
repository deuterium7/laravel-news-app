<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\TestCase;
use Tests\UserStub;

class ArticleViewsTest extends TestCase
{
    use UserStub;

    /** @test */
    public function can_show_articles_view()
    {
        $this->get('articles')
            ->assertStatus(200)
            ->assertViewIs('articles.index')
            ->assertViewHas('articles');
    }

    /** @test */
    public function can_show_article_view()
    {
        $article = Article::first();
        $user = $this->createUserStub();

        $this->actingAs($user)
            ->get("articles/$article->id")
            ->assertStatus(200)
            ->assertViewIs('articles.show')
            ->assertViewHas('article')
            ->assertViewHas('comments');

        $user->delete();
    }

    /** @test */
    public function can_show_create_article_view()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('articles/create')
            ->assertStatus(200)
            ->assertViewIs('articles.create')
            ->assertSee(trans('catalog.create'));

        $admin->delete();
    }

    /** @test */
    public function can_show_edit_article_view()
    {
        $article = Article::first();
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get("articles/$article->id/edit")
            ->assertStatus(200)
            ->assertViewIs('articles.edit')
            ->assertViewHas('article')
            ->assertSee(trans('catalog.update'));

        $admin->delete();
    }
}
