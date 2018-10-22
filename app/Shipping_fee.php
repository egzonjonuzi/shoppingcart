<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_fee extends Model
{
    protected $table = "tbl_shipping_fee";
    protected $primaryKey="shipping_fee_id";
    public  $timestamps = false;

    protected $hidden = ['customer_type','shipping_method','shipping_method_name'];
    protected $appends = ['shippingMethodName','customerTypeName','shippingMethodDescription'];

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


    public function shipping_method_name()
    {
        return $this->belongsTo(Shipping_method::class,'shipping_method_id','shipping_method_id')->select('shipping_method_id','shipping_method_name','shipping_method_description');
    }

    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
