<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class NavbarLinksTest extends TestCase
{
    use WithoutMiddleware;

    public function test_uri_news()
    {
        $response = $this->get('/');
        $response->assertViewIs('articles.index');
    }

    public function test_uri_categories()
    {
        $response = $this->get('categories');
        $response->assertViewIs('categories.index');
    }

    public function test_uri_locale()
    {
        $response = $this->get('locale/en');
        $response->assertSessionHas('locale', 'en')
            ->assertRedirect();

        $response = $this->get('locale/uk');
        $response->assertSessionHas('locale', 'uk')
            ->assertRedirect();
    }

    public function test_uri_logout()
    {
        $response = $this->get('logout');
        $response->assertSessionMissing('user');
    }

    public function test_uri_admin()
    {
        $response = $this->get('admin/news');
        $response->assertViewIs('admin.news');

        $response = $this->get('admin/categories');
        $response->assertViewIs('admin.categories');
    }
}
