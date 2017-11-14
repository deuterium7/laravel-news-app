<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ViewsTest extends TestCase
{
    use WithoutMiddleware;

    public function test_article_index()
    {
        $responce = $this->get('articles');
        $responce->assertViewHas('articles');
    }

    public function test_category_index()
    {
        $responce = $this->get('categories');
        $responce->assertViewHas('categories');
    }

    public function test_admin_news()
    {
        $responce = $this->get('admin/news');
        $responce->assertViewHas('articles');
    }

    public function test_admin_categories()
    {
        $responce = $this->get('admin/categories');
        $responce->assertViewHas('categories');
    }

    public function test_admin_comments()
    {
        $responce = $this->get('admin/comments');
        $responce->assertViewHas('comments');
    }
}
