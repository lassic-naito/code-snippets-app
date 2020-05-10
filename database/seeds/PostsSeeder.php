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
            ['user_id'=>1, 'parent_category_id'=>0, 'category_name' => 'HTML'],
            ['id'=>2, 'parent_category_id'=>0, 'category_name' => 'CSS'],
            ['id'=>3, 'parent_category_id'=>0, 'category_name' => 'PHP'],
            ['id'=>4, 'parent_category_id'=>3, 'category_name' => 'Laravel'],
            ['id'=>5, 'parent_category_id'=>0, 'category_name' => 'Javascript'],
        ];
        
        DB::table('posts')->insert($posts);
    }
}
