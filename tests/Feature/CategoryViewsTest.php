<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Tests\UserStub;

class CategoryViewsTest extends TestCase
{
    use UserStub;

    /** @test */
    public function can_show_categories_view()
    {
        $this->get('categories')
            ->assertStatus(200)
            ->assertViewIs('categories.index')
            ->assertViewHas('categories');
    }

    /** @test */
    public function can_show_category_view()
    {
        $category = Category::first();

        $this->get("categories/$category->id")
            ->assertStatus(200)
            ->assertViewIs('categories.show')
            ->assertViewHas('articles');
    }

    /** @test */
    public function can_show_create_category_view()
    {
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get('categories/create')
            ->assertStatus(200)
            ->assertViewIs('categories.create')
            ->assertSee(trans('catalog.create'));

        $admin->delete();
    }

    /** @test */
    public function can_show_edit_category_view()
    {
        $category = Category::first();
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get("categories/$category->id/edit")
            ->assertStatus(200)
            ->assertViewIs('categories.edit')
            ->assertViewHas('category')
            ->assertSee(trans('catalog.update'));

        $admin->delete();
    }
}
