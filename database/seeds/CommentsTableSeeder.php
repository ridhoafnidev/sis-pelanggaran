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
        $comments = [
            [
                'post_id' => 1,
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'body' => 'Hello guys, nice to have you on the platform! There will be a lot of great stuff coming soon. We will keep you posted for the latest news. Don\'t forget, You\'re Awesome!',
                'status' => 1,
            ],
            [
                'post_id' => 2,
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'body' => 'Hello guys, nice to have you on the platform! There will be a lot of great stuff coming soon. We will keep you posted for the latest news. Don\'t forget, You\'re Awesome!',
                'status' => 1,
            ],
        ];

        DB::table('comments')->insert($comments);
    }
}
