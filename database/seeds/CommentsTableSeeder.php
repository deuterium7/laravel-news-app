<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(
            \App\Models\Comment::class,
            \Illuminate\Support\Facades\Config::get('constants.COMMENTS_SEED')
        )->create();
    }
}
