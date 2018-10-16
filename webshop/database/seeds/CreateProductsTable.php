<?php

use Illuminate\Database\Seeder;

class CreateProductsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Plant',
            'description' => 'Een mooie groene plant.',
            'price' => 10,
            'discount' => 5,
            'image_url' => 'noimage.jgp',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
