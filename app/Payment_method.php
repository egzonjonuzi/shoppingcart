<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    protected $table ="tbl_payment_method";
    protected  $primaryKey = "payment_method_id";
    public  $timestamps = false;

    public function prices()
    {
        return $this->hasMany(Payment_fee::class,'payment_method_id','payment_method_id');
    }

    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
