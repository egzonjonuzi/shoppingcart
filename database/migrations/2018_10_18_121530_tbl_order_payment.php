<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblOrderPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('tbl_order_payment', function (Blueprint $table) {
          // $table->integer('order_payment_id')->index();       
           $table->unsignedInteger('order_id')->index();
            $table->foreign('order_id')->references('order_id')->on('tbl_order');     
            $table->unsignedInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('tbl_payment_method');
            $table->integer('payment_status')->default(1);
            $table->float('price',7,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tbl_order_payment');
  }
}
