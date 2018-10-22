<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "tbl_order";
    public $timestamps = false;

    protected $hidden = ['customer', 'customer_address'];
    protected $appends = ['email', 'customerName', 'customerFullAddress'];

    public function change_fillable(array $data)
    {
        $this->fillable = $data;
    }

    public function getemailAttribute()
    {
        return $this->customer->email;
    }

    public function getcustomerNameAttribute()
    {
        return $this->customer_address->name . ' ' . $this->customer_address->surname;
    }

    public function getcustomerFullAddressAttribute()
    {
        return $this->customer_address->street . ', ' . $this->customer_address->house_number.', '.$this->customer_address->city;
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id')
            ->select('customer_id', 'email');
    }

    public function products()
    {
        return $this->hasMany(Order_details::class, 'order_id', 'order_id')->with('products');
    }

    public function customer_address()
    {
        return $this->hasOne(Customer_address::class, 'customer_id', 'customer_id');
    }


}
