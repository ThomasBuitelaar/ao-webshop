<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => "Food",
            ],
            [
                'name' => "Fire arms",
            ],
            [
                'name' => "Pets",
            ],
            [
                'name'  => "Clothing",
            ],
            [
                'name' => "Plants",
            ]
        ]);
    }
}
