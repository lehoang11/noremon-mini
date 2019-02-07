<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';

    protected $fillable = ['order_id', 'email', 'full_name', 'phone','code_tax','address','city','district','wards'];
}
