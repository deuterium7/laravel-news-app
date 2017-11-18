<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Tests\Catalog;
use Tests\TestCase;
use Tests\UserStub;

class CategoryControllerTest extends TestCase
{
    use UserStub, Catalog;

    /** @test */
    public function admin_can_create_category()
    {
        $admin = $this->createUserStub('admin');
        $this->be($admin);

        $this->get('categories/create')
            ->assertStatus(200);

        $request = [
            'name'   => 'Can create category name',
            'image'  => 'Can create category image',
            '_token' => csrf_token(),
        ];

        $this->post('categories', $request)
            ->assertStatus(302);
        $category = $this->latest(Category::class);

        $this->assertEquals('Can create category name', $category->name);
    }

    /** @test */
    public function admin_can_update_category()
    {
        $admin = $this->latest(User::class);
        $category = $this->latest(Category::class);

        $this->be($admin);
        $this->get("categories/$category->id/edit")
            ->assertStatus(200);

        $request = [
            'name'   => 'Can update category name',
            'image'  => 'Can update category image',
            '_token' => csrf_token(),
        ];

        $this->put("categories/$category->id", $request)
            ->assertStatus(302);
        $categoryUpdate = $this->latest(Category::class);

        $this->assertNotEquals($category, $categoryUpdate);
    }

    /** @test */
    public function admin_can_delete_category()
    {
        $admin = $this->latest(User::class);
        $categoryDelete = $this->latest(Category::class);

        $this->be($admin);
        $this->get('admin/categories')
            ->assertStatus(200);

        $this->delete("categories/$categoryDelete->id", ['_token' => csrf_token()])
            ->assertStatus(302);
        $categoryOld = $this->latest(Category::class);

        $this->assertNotEquals($categoryDelete, $categoryOld);

        $admin->delete();
    }
}
