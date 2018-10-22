<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_payment extends Model
{
    protected $table = "tbl_order_payment";
    public  $timestamps = false;

    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
