<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'salary_id',
        'name',
        'surname',
        'father_name',
        'phone',
        'address',
        'start_time',
        'end_time',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
