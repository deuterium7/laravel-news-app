<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\UserStub;

class AdminViewsTest extends TestCase
{
    use UserStub;

    /** @test */
    public function can_show_articles_view_panel()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('admin/news')
            ->assertStatus(200)
            ->assertViewIs('admin.news')
            ->assertViewHas('articles')
            ->assertSee(trans('catalog.create'))
            ->assertSee(trans('catalog.edit'))
            ->assertSee(trans('catalog.destroy'));

        $admin->delete();
    }

    /** @test */
    public function can_show_categories_view_panel()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('admin/categories')
            ->assertStatus(200)
            ->assertViewIs('admin.categories')
            ->assertViewHas('categories')
            ->assertSee(trans('catalog.create'))
            ->assertSee(trans('catalog.edit'))
            ->assertSee(trans('catalog.destroy'));

        $admin->delete();
    }

    /** @test */
    public function can_show_users_view_panel()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('admin/users')
            ->assertStatus(200)
            ->assertViewIs('admin.users')
            ->assertViewHas('users')
            ->assertSee(trans('catalog.admin'))
            ->assertSee(trans('catalog.ban'));

        $admin->delete();
    }

    /** @test */
    public function can_show_comments_view_panel()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('admin/comments')
            ->assertStatus(200)
            ->assertViewIs('admin.comments')
            ->assertViewHas('comments')
            ->assertSee(trans('catalog.destroy'));

        $admin->delete();
    }

    /** @test */
    public function can_show_logs_view_panel()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('admin/logs')
            ->assertStatus(200)
            ->assertViewIs('laravel-log-viewer::log')
            ->assertSee(trans('catalog.home'));

        $admin->delete();
    }
}
