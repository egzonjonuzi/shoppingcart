<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tbl_order_details', function (Blueprint $table) {
        $table->increments('order_details_id')->index();
        $table->unsignedInteger('order_id');
        $table->foreign('order_id')->references('order_id')->on('tbl_order');       
    
       $table->unsignedInteger('product_id');
       $table->foreign('product_id')->references('product_id')->on('tbl_product'); 
       $table->integer('product_warranty_months')->default(0);
       $table->integer('product_quantity');
       $table->float('product_price',7,2);
       $table->integer('product_discount_percentage')->default(0);
       $table->float('product_total_without_discount',7,2)->default(0);
       $table->float('product_total',7,2);      
   });

}    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tbl_order_details');
  }
}
