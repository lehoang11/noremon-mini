<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = 'product_photos';

    public $timestamps = false;

    protected $fillable = ['product_id', 'photo'];

}
