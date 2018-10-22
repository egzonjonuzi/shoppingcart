<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_shipping extends Model
{
    protected $table = "tbl_order_shipping";
    public  $timestamps = false;

    protected $hidden = ['customer_type','shipping_method'];
    protected $appends = ['shippingMethodName','shippingMethodDescription','customerTypeName'];



    public function getshippingMethodNameAttribute() {
        return $this->shipping_method->shipping_method_name;
    }

    public function getshippingMethodDescriptionAttribute() {
        return $this->shipping_method->shipping_method_description;
    }

    public function getcustomerTypeNameAttribute() {
        return $this->customer_type->customer_type_name;
    }



    public function customer_type()
    {
        return $this->hasOne(Customer_type::class, 'customer_type_id', 'customer_type_id');
    }

    public function shipping_method()
    {
        return $this->hasOne(Shipping_method::class, 'shipping_method_id', 'shipping_method_id');
    }


    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
