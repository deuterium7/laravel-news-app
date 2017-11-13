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
        for ($i = 1; $i <= 300; $i++) {
            DB::table('role_user')->insert([
                'user_id' => $i,
                'role_id' => 1,
            ]);
        }

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 2,
        ]);
    }
}
