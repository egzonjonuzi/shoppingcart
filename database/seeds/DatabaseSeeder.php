<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tbl_customer_type')->insert([
            'customer_type_name' => 'order as a company',
        ]);

        DB::table('tbl_customer_type')->insert([
            'customer_type_name' => 'order as a customer',
        ]);

        DB::table('tbl_product')->insert([
            'product_name' => 'Samsung Galaxy S9',
            'product_price' =>500,
            'product_image' => 'samsung.jpg'
        ]);


        DB::table('tbl_product')->insert([
            'product_name' => 'Lenovo T600',
            'product_price' =>680,
            'product_image' => 'lenovo.jpg'
        ]);

        DB::table('tbl_product_warranty')->insert([
            'product_warranty_months' => 0,
            'product_warranty_discount_percentage' => 15
        ]);

        DB::table('tbl_product_warranty')->insert([
            'product_warranty_months' => 3,
            'product_warranty_discount_percentage' => 10
        ]);

        DB::table('tbl_product_warranty')->insert([
            'product_warranty_months' => 12,
            'product_warranty_discount_percentage' => 5
        ]);

    }
}
