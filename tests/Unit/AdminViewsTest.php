<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminViewsTest extends TestCase
{
    /**
     * @var User
     */
    protected $admin;

    /**
     * Базовые значения для теста.
     */
    public function setUp()
    {
        parent::setUp();

        $this->admin = factory(User::class)->make(['admin' => true]);
        $this->actingAs($this->admin);
    }

    /** @test */
    public function the_admin_can_see_news_panel()
    {
        $this->get('admin/news')
            ->assertStatus(200)
            ->assertSee(trans('catalog.create'))
            ->assertSee(trans('catalog.edit'))
            ->assertSee(trans('catalog.destroy'));
    }

    /** @test */
    public function the_admin_can_see_categories_panel()
    {
        $this->get('admin/categories')
            ->assertStatus(200)
            ->assertSee(trans('catalog.create'))
            ->assertSee(trans('catalog.edit'))
            ->assertSee(trans('catalog.destroy'));
    }

    /** @test */
    public function the_admin_can_see_users_panel()
    {
        $this->get('admin/users')
            ->assertStatus(200)
            ->assertSee(trans('catalog.admin'))
            ->assertSee(trans('catalog.ban'));
    }

    /** @test */
    public function the_admin_can_see_comments_panel()
    {
        $this->get('admin/comments')
            ->assertStatus(200)
            ->assertSee(trans('catalog.destroy'));
    }

    /** @test */
    public function the_admin_can_see_logs_panel()
    {
        $this->get('admin/logs')
            ->assertStatus(200)
            ->assertSee(trans('catalog.home'));
    }
}
