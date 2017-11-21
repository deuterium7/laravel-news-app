<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;

class ArticleViewsTest extends TestCase
{
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

        $this->user = factory(User::class)->make();
        $this->admin = factory(User::class)->make(['admin' => true]);
        $this->articleId = Article::first()->id;
    }

    /** @test */
    public function the_guest_can_see_list_of_articles()
    {
        $this->get('articles')
            ->assertStatus(200);
    }

    /** @test */
    public function the_user_can_see_article()
    {
        $this->actingAs($this->user)
            ->get("articles/$this->articleId")
            ->assertStatus(200);
    }

    /** @test */
    public function the_admin_can_see_article_create_form()
    {
        $this->actingAs($this->admin)
            ->get('articles/create')
            ->assertStatus(200)
            ->assertSee(trans('catalog.create'));
    }

    /** @test */
    public function the_admin_can_see_article_update_form()
    {
        $this->actingAs($this->admin)
            ->get("articles/$this->articleId/edit")
            ->assertStatus(200)
            ->assertSee(trans('catalog.update'));
    }
}
