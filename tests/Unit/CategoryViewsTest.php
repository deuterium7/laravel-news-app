<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryViewsTest extends TestCase
{
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

        $this->admin = factory(User::class)->make(['admin' => true]);
        $this->categoryId = Category::first()->id;
    }

    /** @test */
    public function the_guest_can_see_list_of_categories()
    {
        $this->get('categories')
            ->assertStatus(200);
    }

    /** @test */
    public function the_guest_can_see_articles_from_category()
    {
        $this->get("categories/$this->categoryId")
            ->assertStatus(200);
    }

    /** @test */
    public function the_admin_can_see_category_create_form()
    {
        $this->actingAs($this->admin)
            ->get('categories/create')
            ->assertStatus(200)
            ->assertSee(trans('catalog.create'));
    }

    /** @test */
    public function the_admin_can_see_category_update_form()
    {
        $this->actingAs($this->admin)
            ->get("categories/$this->categoryId/edit")
            ->assertStatus(200)
            ->assertSee(trans('catalog.update'));
    }
}
