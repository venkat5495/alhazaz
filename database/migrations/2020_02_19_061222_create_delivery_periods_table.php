<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('ar_name')->nullable();
            $table->double('delivery_amount')->nullable();
            $table->double('total_invoice_amount')->nullable();
            $table->enum('status', ['active', 'deactive'])->nullable();
            $table->longText('states')->nullable();
            $table->longText('cities')->nullable();
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
        Schema::dropIfExists('delivery_periods');
    }
}
