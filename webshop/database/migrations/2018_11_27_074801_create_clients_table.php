<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {

            // Client Information
            $table->increments('client_id');
            $table->integer('user_id');
            $table->forein('user_id')->referances('id')->on('users')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('phone_number');

            // Billing information
            $table->string('billing_postal_code');
            $table->integer('billing_house_number');
            $table->string('billing_house_number_addition')->nullable();
            $table->string('billing_street');
            $table->string('billing_city');
            $table->string('billing_country');

            // Shipping information
            $table->string('shipping_postal_code');
            $table->integer('shipping_house_number');
            $table->string('shipping_house_number_addition')->nullable();
            $table->string('shipping_street');
            $table->string('shipping_city');
            $table->string('shipping_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
