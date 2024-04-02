<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\Order_detail');
    }

    protected $menuArr=[
        'menu_id'=>'array',
        'qty' => 'array'
    ];
}
