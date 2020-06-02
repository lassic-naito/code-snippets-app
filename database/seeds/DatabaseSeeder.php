<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // DB::statement('ALTER TABLE posts DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE post_tag DISABLE TRIGGER ALL;');
        
        // $this->call(UsersTableSeeder::class);
        $this->call('CategoriesSeeder');
        // $this->call('ReviewsSeeder');
        $this->call('TagsSeeder');
        // $this->call('PostsSeeder');
        // $this->call('UserSeeder');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
        // DB::statement('ALTER TABLE posts ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE post_tag ENABLE TRIGGER ALL;');

    }
}
