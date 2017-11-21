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
    public function admin_can_create_category()
    {
        $this->get('categories/create')
            ->assertStatus(200);

        $request = [
            'name'        => 'Can create category name',
            'image'       => 'Can create category image',
            '_token'      => csrf_token(),
        ];

        $this->post('categories', $request)
            ->assertStatus(302);
        $category = Category::orderBy('id', 'desc')->first();

        $this->assertEquals('Can create category name', $category->name);
    }

    /** @test */
    public function admin_can_update_category()
    {
        $category = Category::orderBy('id', 'desc')->first();

        $this->get("categories/$category->id/edit")
            ->assertStatus(200);

        $request = [
            'name'   => 'Can update category name',
            'image'  => 'Can update category image',
            '_token' => csrf_token(),
        ];

        $this->put("categories/$category->id", $request)
            ->assertStatus(302);
        $categoryUpdate = Category::orderBy('id', 'desc')->first();

        $this->assertNotEquals($category, $categoryUpdate);
    }

    /** @test */
    public function admin_can_delete_category()
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
