<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('banner', 100);
            $table->integer('product_category');
            $table->integer('banner_category');
            $table->enum('status', ['active', 'deactive'])->default('deactive');
            $table->date('start_time');
            $table->date('end_time');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_banners');
    }
}
