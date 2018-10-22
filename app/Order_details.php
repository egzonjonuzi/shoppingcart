<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    protected $table = "tbl_order_details";
    public  $timestamps = false;
    protected $fillable = ["product_name","product_image","product_quantity","product_id","product_price","product_total","product_discount_percentage","product_total_without_discount","product_warranty_months"];
    public $fillable_insert_db = ["order_id","product_quantity","product_id","product_price","product_total","product_discount_percentage","product_total_without_discount","product_warranty_months"];

    protected $appends = ['productName'];
    protected $hidden = ['products'];
    public function change_fillable(array $data) {
    	$this->fillable = $data;
    }

    public function getproductNameAttribute()
    {
        return $this->products->product_name;
    }

    public function order_product()
    {
        return $this->belongsTo(Order::class,'order_id','order_id')->with('product');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

}
