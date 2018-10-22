<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_fee extends Model
{
    protected $table = "tbl_payment_fee";
    protected $primaryKey="payment_fee_id";
    public  $timestamps = false;

    protected $hidden = ['customer_type','payment_method','payment_method_name'];
    protected $appends = ['paymentMethodName','customerTypeName','paymentMethodDescription'];

    public function getpaymentMethodNameAttribute() {
        return $this->payment_method->payment_method_name;
    }

    public function getpaymentMethodDescriptionAttribute() {
        return $this->payment_method->payment_method_description;
    }

    public function getcustomerTypeNameAttribute() {
        return $this->customer_type->customer_type_name;
    }

    public function customer_type()
    {
        return $this->hasOne(Customer_type::class, 'customer_type_id', 'customer_type_id');
    }

    public function payment_method()
    {
        return $this->hasOne(payment_method::class, 'payment_method_id', 'payment_method_id');
    }

    public function payment_method_name()
    {
        return $this->belongsTo(Payment_method::class,'payment_method_id','payment_method_id')->select('payment_method_id','payment_method_name','payment_method_description');
    }

    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
