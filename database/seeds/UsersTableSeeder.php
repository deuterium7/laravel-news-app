<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // администраторы загружают статьи
        $categoriesCount = \App\Models\Category::count();
        factory(\App\Models\User::class, 10)->create(['admin' => true])->each(function ($u) use ($categoriesCount) {
            $u->articles()
                ->saveMany(factory(\App\Models\Article::class, 15)
                ->create([
                    'category_id' => rand(1, $categoriesCount),
                    'user_id' => $u->id
                ]));
        });

        // пользователи комментируют статьи
        $articlesCount = \App\Models\Article::count();
        factory(\App\Models\User::class, 100)->create()->each(function ($u) use ($articlesCount) {
            $u->comments()
                ->saveMany(factory(\App\Models\Comment::class, 20)
                ->create([
                    'article_id' => rand(1, $articlesCount),
                    'user_id' => $u->id
                ]));
        });
    }
}
