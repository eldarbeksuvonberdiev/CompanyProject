<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    protected $fillable = ['company_name', 'date', 'text'];

    public function materialDeliveryNotes()
    {
        return $this->hasMany(MaterialDeliveryNote::class,'delivery_note_id');
    }
}
