<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPaymentFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tbl_payment_fee', function (Blueprint $table) {
        $table->increments('payment_fee_id')->index();
        $table->unsignedInteger('payment_method_id');
        $table->foreign('payment_method_id')->references('payment_method_id')->on('tbl_payment_method');
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
      Schema::dropIfExists('tbl_payment_fee');
  }
}
