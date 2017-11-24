<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use WithoutEvents, DatabaseTransactions;

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
        $this->be($this->admin);
    }

    /** @test */
    public function the_admin_can_create_category()
    {
        $this->get('categories/create')
            ->assertStatus(200);

        $attributes = factory(Category::class)->make()->toArray();
        $category = Category::create($attributes);

        $this->assertEquals($attributes['name'], $category->name);
    }

    /** @test */
    public function the_admin_can_update_category()
    {
        $category = Category::orderBy('id', 'desc')->first();

        $this->get("categories/$category->id/edit")
            ->assertStatus(200);

        $request = [
            'name'   => 'Can update category name',
            '_token' => csrf_token(),
        ];

        $this->put("categories/$category->id", $request)
            ->assertStatus(302);
        $categoryUpdate = Category::orderBy('id', 'desc')->first();

        $this->assertNotEquals($category, $categoryUpdate);
    }

    /** @test */
    public function the_admin_can_delete_category()
    {
        $categoryDelete = Category::orderBy('id', 'desc')->first();

        $this->get('admin/categories')
            ->assertStatus(200);

        $this->delete("categories/$categoryDelete->id", ['_token' => csrf_token()])
            ->assertStatus(302);
        $categoryOld = Category::orderBy('id', 'desc')->first();

        $this->assertNotEquals($categoryDelete, $categoryOld);
    }
}
