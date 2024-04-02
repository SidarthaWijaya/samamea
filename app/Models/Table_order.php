<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_order extends Model
{
    protected $fillable =[ 'table_id','table_status', 'session','total'];
    use HasFactory;
}
