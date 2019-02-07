<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['type','parent_id', 'name', 'slug', 'image', 'description','sort_order','status'];
}
