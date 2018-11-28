<?php

use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'name' => "",
                'price' => "",
                'description' => "",
            ],
            [
                'name' => "",
                'price' => "",
                'description' => "",
            ],
            [
                'name' => "",
                'price' => "",
                'description' => "",
            ],
            [
                'name' => "",
                'price' => "",
                'description' => "",
            ],
            [
                'name' => "",
                'price' => "",
                'description' => "",
            ]
        ])
    }
}
