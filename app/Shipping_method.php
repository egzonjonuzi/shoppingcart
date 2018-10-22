<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_method extends Model
{
    protected $table ="tbl_shipping_method";
    protected  $primaryKey = "shipping_method_id";
    public  $timestamps = false;
    public function prices()
    {
        return $this->hasMany(Shipping_fee::class,'shipping_method_id','shipping_method_id');
    }

    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
