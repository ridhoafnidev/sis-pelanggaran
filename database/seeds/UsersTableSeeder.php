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
        $users = [
            [
                'name' => 'Admin', 
                'email' => 'admin@mail.com', 
                'password' => bcrypt('password'), 
                'role' => 'admin', 
                'avatar' => '/images/user-icon.png'
            ],
            [
                'name' => 'Author', 
                'email' => 'author@mail.com', 
                'password' => bcrypt('password'), 
                'role' => 'author', 
                'avatar' => '/images/user-icon.png'
            ],
        ];

        DB::table('users')->insert($users);
    }
}
