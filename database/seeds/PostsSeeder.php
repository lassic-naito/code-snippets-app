<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            ['user_id'=>1, 'category_id'=>1, 'title'=>'test title', 'content'=>'test text'],
            ['user_id'=>1, 'category_id'=>2, 'title'=>'test title', 'content'=>'test text'],
            ['user_id'=>2, 'category_id'=>3, 'title'=>'test title', 'content'=>'test text'],
        ];
        
        DB::table('posts')->insert($posts);
    }
}
