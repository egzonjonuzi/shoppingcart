<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id')->index();
            $table->string('product_name');        
            $table->string('product_short_description',100)->default('');
            $table->string('product_long_description',5000)->default('');
            $table->float('product_price',7,2);
            $table->string('product_image');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tbl_product');
  }
}
