<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblShippingFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tbl_shipping_fee', function (Blueprint $table) {
        $table->increments('shipping_fee_id')->index();
        $table->unsignedInteger('shipping_method_id');
        $table->foreign('shipping_method_id')->references('shipping_method_id')->on('tbl_shipping_method');
        $table->unsignedInteger('customer_type_id');
        $table->foreign('customer_type_id')->references('customer_type_id')->on('tbl_customer_type');
        $table->float('price');
        $table->boolean('is_enabled')->default(1);
    });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tbl_shipping_fee');
  }
}
