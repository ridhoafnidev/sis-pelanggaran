<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'title' => 'IDBlog',
            'tagline' => 'Simple Blog with Laravel Framework',
            'email' => 'idstackdeveloper@gmail.com',
            'phone' => '+62 8996568953',
            'address' => 'Maja 2, Rt/Rw 01/02, Kec. Astanajapura, Kab. Cirebon, 45181',
            'so_facebook' => 'https://facebook.com/idstack',
            'so_twitter' => 'https://facebook.com/hakim_816',
            'so_instagram' => 'https://instagram.com/idstack'
        ];

        DB::table('settings')->insert($settings);
    }
}
