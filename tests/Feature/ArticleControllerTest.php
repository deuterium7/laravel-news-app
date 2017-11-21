<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Tests\Catalog;
use Tests\TestCase;
use Tests\UserStub;

class ArticleControllerTest extends TestCase
{
    use UserStub, Catalog;

    /** @test */
    public function admin_can_create_article()
    {
        $admin = $this->createUserStub('admin');
        $category = Category::first();

        $this->be($admin);
        $this->get('articles/create')
            ->assertStatus(200);

        $request = [
            'user_id'     => $admin->id,
            'category_id' => $category->id,
            'title'       => 'Can create article title',
            'image'       => 'Can create article image',
            'body'        => 'Can create article body',
            '_token'      => csrf_token(),
        ];

        $this->post('articles', $request)
            ->assertStatus(302);
        $article = $this->latest(Article::class);

        $this->assertEquals('Can create article title', $article->title);
    }

    /** @test */
    public function admin_can_update_article()
    {
        $admin = $this->latest(User::class);
        $article = $this->latest(Article::class);

        $this->be($admin);
        $this->get("articles/$article->id/edit")
            ->assertStatus(200);

        $request = [
            'title'  => 'Can update article title',
            'image'  => 'Can update article image',
            'body'   => 'Can update article body',
            '_token' => csrf_token(),
        ];

        $this->put("articles/$article->id", $request)
            ->assertStatus(302);
        $articleUpdate = $this->latest(Article::class);

        $this->assertNotEquals($article, $articleUpdate);
    }

    /** @test */
    public function admin_can_delete_article()
    {
        $admin = $this->latest(User::class);
        $articleDelete = $this->latest(Article::class);

        $this->be($admin);
        $this->get('admin/news')
            ->assertStatus(200);

        $this->delete("articles/$articleDelete->id", ['_token' => csrf_token()])
            ->assertStatus(302);
        $articleOld = $this->latest(Article::class);

        $this->assertNotEquals($articleDelete, $articleOld);

        $admin->delete();
    }
}
