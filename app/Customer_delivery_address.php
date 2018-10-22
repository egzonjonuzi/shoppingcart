<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_delivery_address extends Model
{
    protected $table = "tbl_customer_delivery_address";
    public  $timestamps = false;
    private $insert_fillable = ['name','surname','street','house_number','zip','city','country'];
    private $insert_fillable_db = ['customer_id','name','surname','street','house_number','zip','city','country'];
    public function change_fillable($type) {
        switch ($type) {
            case "insert":
                $this->fillable($this->insert_fillable);
                break;
            case "insert_db":
                $this->fillable($this->insert_fillable_db);
                break;
            default:
                $this->fillable([]);
                break;
        }
    }
}
