<?php

use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            ['user_id'=>1, 'post_id'=>27, 'content'=>'test text','created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['user_id'=>1, 'post_id'=>27, 'content'=>'test text2','created_at' => new DateTime(), 'updated_at' => new DateTime()],
        ];
        
        DB::table('reviews')->truncate();
        DB::table('reviews')->insert($reviews);
    }
}
