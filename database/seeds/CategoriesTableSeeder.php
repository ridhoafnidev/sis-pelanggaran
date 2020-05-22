<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'title' => 'Sample Category',
            'slug' => 'sample-category'
        ];

        DB::table('categories')->insert($categories);
    }
}
