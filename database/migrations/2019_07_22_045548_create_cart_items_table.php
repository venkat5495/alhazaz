<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('product_id')->unsigned();
            $table->integer('session_key');
            $table->integer('product_id');
            $table->integer('user_id')->nullable();            
            $table->integer('product_qty');
            $table->double('price', 8, 2);
            $table->string('tax');
            $table->string('shipping_type');
            $table->double('shipping');
            $table->timestamps();

            //$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
