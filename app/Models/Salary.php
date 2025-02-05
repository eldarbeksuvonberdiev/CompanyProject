<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['name'];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
