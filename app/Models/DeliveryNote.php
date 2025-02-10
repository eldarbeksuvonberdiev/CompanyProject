<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    protected $fillable = ['company_name','date', 'text'];
}
