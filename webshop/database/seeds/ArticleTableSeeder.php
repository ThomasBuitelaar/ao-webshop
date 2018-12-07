<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
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
                'name' => "Fish",
                'imagePath' => "img1.png",
                'price' => "5.99",
                'description' => "very nice animal to either shoot or eat.",
            ],
            [
                'name' => "Really cool gun",
                'imagePath' => "img2.png",
                'price' => "500",
                'description' => "you can shoot fishes or something.",
            ],
            [
                'name' => "Buisness suit",
                'imagePath' => "img3.png",
                'price' => "149.99",
                'description' => "Really good atire to wear while shooting fish.",
            ],
            [
                'name' => "Funflower",
                'imagePath' => "img4.png",
                'price' => "3.99",
                'description' => "Some cool flower that is named after the hot ball in the sky.",
            ],
            [
                'name' => "Cat",
                'imagePath' => "img5.png",
                'price' => "0",
                'description' => "Cats are the supperior pet.d",
            ]
        ]);
    
    }
}
