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
        factory(
            \App\Models\User::class,
            \Illuminate\Support\Facades\Config::get('constants.USERS_SEED')
        )->create();
    }
}
