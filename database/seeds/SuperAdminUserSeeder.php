<?php

use Illuminate\Database\Seeder;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'role_id' => '2',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456'),
            'avatar' => 'default.png',
        ]);
    }
}
