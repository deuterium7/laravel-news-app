<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use WithoutEvents, DatabaseTransactions;

    /**
     * @var User
     */
    protected $admin;

    /**
     * @var int
     */
    protected $categoryId;

    /**
     * Базовые значения для теста.
     */
    public function setUp()
    {
        parent::setUp();

        $this->admin = factory(User::class)->create(['admin' => true]);
        $this->be($this->admin);

        $this->categoryId = Category::first()->id;
    }

    /** @test */
    public function the_admin_can_create_article()
    {
        $this->get('articles/create')
            ->assertStatus(200);

        $attributes = factory(Article::class)->make()->toArray();
        $article = Article::create($attributes);

        $this->assertEquals($attributes['title'], $article->title);
    }

    /** @test */
    public function the_admin_can_update_article()
    {
        $article = Article::latest()->first();

        $this->get("articles/$article->id/edit")
            ->assertStatus(200);

        $request = [
            'title'  => 'Can update article title',
            'body'   => factory(Article::class)->make()->body,
            '_token' => csrf_token(),
        ];

        $this->put("articles/$article->id", $request)
            ->assertStatus(302);
        $articleUpdate = Article::latest()->first();

        $this->assertNotEquals($article, $articleUpdate);
    }

    /** @test */
    public function the_admin_can_delete_article()
    {
        $articleDelete = Article::latest()->first();

        $this->get('admin/news')
            ->assertStatus(200);

        $this->delete("articles/$articleDelete->id", ['_token' => csrf_token()])
            ->assertStatus(302);
        $articleOld = Article::latest()->first();

        $this->assertNotEquals($articleDelete, $articleOld);
    }
}
