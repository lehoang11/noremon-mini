<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'description', 'module', 'status'];


    public function users()
    {
      return $this->belongsToMany(User::class);
    }
}
