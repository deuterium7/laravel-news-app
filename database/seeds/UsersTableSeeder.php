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
        factory('App\Models\User', 10)->create()->each(function($u) {
            //$u->roles()->save(factory(App\Models\Role::class))->make();
        });
    }
}
