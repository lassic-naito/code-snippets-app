<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['parent_category_id'=>0, 'name' => 'HTML'],
            ['parent_category_id'=>0, 'name' => 'CSS'],
            ['parent_category_id'=>0, 'name' => 'PHP'],
            ['parent_category_id'=>3, 'name' => 'Laravel'],
            ['parent_category_id'=>0, 'name' => 'Javascript'],
            ['parent_category_id'=>0, 'name' => 'JAVA'],
            ['parent_category_id'=>6, 'name' => 'Spring'],
            ['parent_category_id'=>0, 'name' => 'C'],
            ['parent_category_id'=>0, 'name' => 'C#'],
            ['parent_category_id'=>0, 'name' => 'C++'],
            ['parent_category_id'=>0, 'name' => 'Ruby'],
        ];
        
        DB::table('categories')->truncate();
        DB::table('categories')->insert($categories);
    }
}
