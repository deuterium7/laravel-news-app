<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        auth()->setUser(factory(User::class)->make());
        factory(Category::class, 10)->create();
    }
}
