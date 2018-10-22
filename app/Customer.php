<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "tbl_customer";
    public  $timestamps = false;
   // protected $fillable = ["email","telephone"];

    public function change_fillable(array $data) {
        $this->fillable = $data;
    }
}
