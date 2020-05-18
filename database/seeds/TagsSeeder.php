<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'AWS'],
            ['name' => 'ネイティブアプリ'],
            ['name' => 'デスクトップアプリ'],
            ['name' => 'Webアプリ'],
            ['name' => '初心者'],
            ['name' => 'デバッグ'],
            ['name' => 'インストール'],
            ['name' => '環境設定'],
        ];
        
        DB::table('tags')->truncate();
        DB::table('tags')->insert($tags);
    }
}
