<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

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
        $categoriesCount = Category::count();
        factory(User::class, 1)->create(['admin' => true])->each(function ($u) use ($categoriesCount) {
            auth()->setUser($u);

            for ($i = 0; $i < 100; $i++) {
                $u->articles()
                    ->save(factory(Article::class)
                    ->create([
                        'category_id' => rand(1, $categoriesCount),
                        'user_id'     => $u->id,
                    ]));
            }
        });

        // пользователи комментируют статьи
        $articlesCount = Article::count();
        factory(User::class, 200)->create()->each(function ($u) use ($articlesCount) {
            for ($i = 0; $i < 10; $i++) {
                $u->comments()
                    ->save(factory(Comment::class)
                    ->create([
                        'article_id' => rand(1, $articlesCount),
                        'user_id'    => $u->id,
                    ]));
            }
        });
    }
}
