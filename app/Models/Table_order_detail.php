<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_order_detail extends Model
{
    protected $fillable =[ 'table_order_id','order_id', 'subtotal'];
    
    public function orderdetail(){
        return $this->hasMany('App\Models\Order_detail');
     }
    use HasFactory;
}
