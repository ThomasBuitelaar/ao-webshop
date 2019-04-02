<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id_fk');
            $table->foreign('category_id_fk')->references('category_id')->on('categories')->onDelete('cascade');
            $table->integer('product_id_fk');
            $table->foreign('product_id_fk')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
