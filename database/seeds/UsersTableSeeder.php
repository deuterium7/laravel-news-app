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
        factory(\App\Models\User::class, 1)->create(['admin' => true])->each(function ($u) use ($categoriesCount) {
            $u->articles()
                ->saveMany(factory(\App\Models\Article::class, 100)
                ->create([
                    'category_id' => rand(1, $categoriesCount),
                    'user_id' => $u->id
                ]));
        });

        // пользователи комментируют статьи
        $articlesCount = \App\Models\Article::count();
        factory(\App\Models\User::class, 200)->create()->each(function ($u) use ($articlesCount) {
            for ($i = 0; $i < 10; $i++) {
                $u->comments()
                    ->save(factory(\App\Models\Comment::class)
                    ->create([
                        'article_id' => rand(1, $articlesCount),
                        'user_id' => $u->id
                    ]));
            }
        });
    }
}
