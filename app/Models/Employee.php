<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'role_id',
        'user_id',
        'name',
        'surname',
        'father_name',
        'phone_number',
        'address',
        'start_time',
        'end_time',
        'salary',
    ];
}
