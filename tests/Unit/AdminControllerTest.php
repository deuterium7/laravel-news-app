<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_admin_news()
    {
        $responce = $this->call('GET', 'admin/news');
        $responce->assertViewHas('articles');
    }

    public function test_admin_categories()
    {
        $responce = $this->call('GET', 'admin/categories');
        $responce->assertViewHas('categories');
    }

    public function test_admin_comments()
    {
        $responce = $this->call('GET', 'admin/comments');
        $responce->assertViewHas('comments');
    }
}
