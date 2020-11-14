<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("articles")->insert([
            'title'=>Str::random(10),
            'content'=>'<h1>これはテストの文章です</h1><p>テストテストテストテストテストテストテストテストテスト</p>',
            'row_content'=>'# これはテストの文章です
            テストテストテストテストテストテストテストテストテスト',
            'is_open'=>true,
        ]);
    }
}
