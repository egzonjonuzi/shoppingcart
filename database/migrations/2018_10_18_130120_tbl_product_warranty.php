<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblProductWarranty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('tbl_product_warranty', function (Blueprint $table) {
            $table->increments('product_warranty_id')->index();
            $table->integer('product_warranty_months');        
            $table->integer('product_warranty_discount_percentage');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tbl_product_warranty');
  }
}
