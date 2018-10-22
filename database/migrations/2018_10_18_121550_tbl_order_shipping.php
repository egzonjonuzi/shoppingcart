<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblOrderShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::enableForeignKeyConstraints();

    Schema::create('tbl_order_shipping', function (Blueprint $table) {    
            //$table->integer('order_shipping_id')->index();    
            $table->unsignedInteger('order_id')->index();
            $table->foreign('order_id')->references('order_id')->on('tbl_order'); 
            $table->unsignedInteger('shipping_method_id');
            $table->foreign('shipping_method_id')->references('shipping_method_id')->on('tbl_shipping_method');           
            $table->integer('shipping_status')->default(1);
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
      Schema::dropIfExists('tbl_order_shipping');
  }
}
