<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use WithoutMiddleware;

    public function test_can_create_category()
    {
        $category = new Category();
        $this->assertInstanceOf(Category::class, $category);
    }

    public function test_category_index()
    {
        $response = $this->call('GET', 'categories');
        $this->assertEquals(200, $response->status());
    }

    public function test_category_store()
    {
        $data = [];
        $response = $this->call('POST', 'categories', $data);
        $this->assertEquals(302, $response->status());
    }

    public function test_category_show()
    {
        $response = $this->call('GET', 'categories/1');
        $this->assertEquals(200, $response->status());
    }
}
