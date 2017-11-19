<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::get();

        foreach ($users as $user) {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => 1,
            ]);
        }

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 2,
        ]);
    }
}
