<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Order extends Model
{
    use HasFactory;

    protected $fillable =['nama','room_number','total_qty','subtotal','tax','service','total','status','session'];

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
     public function orderdetail(){
        return $this->hasMany('App\Models\Order_detail');
     }
}
