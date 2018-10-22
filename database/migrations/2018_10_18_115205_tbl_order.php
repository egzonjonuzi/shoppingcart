<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->increments('order_id')->index();
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customer');
            $table->float('order_total', 7, 2)->default(0);
            $table->integer('order_status')->default(1);
            $table->timestamp('order_date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_order');
    }
}
