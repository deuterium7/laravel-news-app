<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(
            \App\Models\Article::class,
            \Illuminate\Support\Facades\Config::get('constants.ARTICLES_SEED')
        )->create();
    }
}
