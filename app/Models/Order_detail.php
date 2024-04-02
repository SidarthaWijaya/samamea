<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;

    protected $fillable =['order_id','menu_id','note','qty'];
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function table_order()
    {
        return $this->belongsTo('App\Models\Table_order_detail');
    }
    public function table()
    {
        return $this->belongsTo('App\Models\Table');
    }
}
