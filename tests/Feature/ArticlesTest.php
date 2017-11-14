<?php

namespace Tests\Unit;

use App\Models\Article;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use WithoutMiddleware;

    public function test_can_create_article()
    {
        $article = new Article();
        $this->assertInstanceOf(Article::class, $article);
    }

    public function test_article_index()
    {
        $response = $this->call('GET', 'articles');
        $this->assertEquals(200, $response->status());
    }

    public function test_article_store()
    {
        $data = [];
        $response = $this->call('POST', 'articles', $data);
        $this->assertEquals(302, $response->status());
    }

    public function test_article_show()
    {
        $response = $this->call('GET', 'articles/1');
        $this->assertEquals(302, $response->status());
    }
}
