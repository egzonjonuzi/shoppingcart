<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $table="tbl_product";

    public function orders()
    {
        return $this->hasMany(Order::class,'order_id','order_id');
    }
}
