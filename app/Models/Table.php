<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function orderdetail(){
    return $this->hasMany('App\Models\Order_detail');
    }
    use HasFactory;
}
