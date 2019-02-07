<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';


    protected $fillable = ['category_id', 'name','slug','image','price','price_sale','content',
						    'description','status','view','hot','created_by','updated_by'];
}
