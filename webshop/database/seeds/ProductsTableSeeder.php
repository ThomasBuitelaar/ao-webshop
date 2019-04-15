<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Fish
        $product = new Product;
        $product->product_name = 'Fish';
        $product->product_price = 5.99;
        $product->product_discount_percentage = 20;
        $product->product_description = "Nice as a pet or a nice fish dinner.";
        $product->product_img = "fish.jpg"; 
        $product->save();

        // Cat
        $product = new Product;
        $product->product_name = 'Cat';
        $product->product_price = 79.99;
        $product->product_discount_percentage = 0;
        $product->product_description = "According to all scientific research, Cats seem to be the best pets there are. This is completely true and we think you should think so as well.";
        $product->product_img = "cat.jpg";
        $product->save();

        // Sunflower
        $product = new Product;
        $product->product_name = 'Sunflower';
        $product->product_price = 1.99;
        $product->product_discount_percentage = 0;
        $product->product_description = "It is a cool flower named after the giant fire ball in the sky. Praise the sun!";
        $product->product_img = "sunflower.jpg";
        $product->save();

        //Rose
        $product = new Product;
        $product->product_name = 'Rose';
        $product->product_price = 2.99;
        $product->product_discount_percentage = 10;
        $product->product_description = "Roses are gray, violets are gray. I'm colorblind.";
        $product->product_img = "rose.jpg";
        $product->save();

        // Sword
        $product = new Product;
        $product->product_name = 'Sword';
        $product->product_price = 299.59;
        $product->product_discount_percentage = 5;
        $product->product_description = "Sharp metal thing. Pretty simple really...";
        $product->product_img = "sword.jpg";
        $product->save();

    /*	
    	// Template
    	$product = new Product;
        $product->product_name = '';
        $product->product_price = ;
        $product->discount_precentage = ;
        $product->product_description = "";
        $product->product_img =
        $product->save();
    */
    }
}
