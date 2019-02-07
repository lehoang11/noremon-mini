<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = ['user_id', 'first_name', 'last_name', 'status', 'phone', 'sex', 'birth_day',
                        'location','photo','is_active'];

}
