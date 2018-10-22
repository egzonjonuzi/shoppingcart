<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblCustomerDeliveryAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer_delivery_address', function (Blueprint $table) {
            $table->unsignedInteger('customer_id')->index();
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customer');
            $table->string('name');
            $table->string('surname');
            $table->string('street');
            $table->integer('house_number');
            $table->string('zip');
            $table->string('city');
            $table->string('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_customer_delivery_address');
    }
}
