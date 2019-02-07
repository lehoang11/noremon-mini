<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_Menu extends Model
{
    protected $table = 'role_menus';

    public $timestamps = false;

    protected $fillable = ['role_id', 'menu_id'];

}
