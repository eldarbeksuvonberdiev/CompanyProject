<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineProduction extends Model
{
    protected $fillable = [
        'production_id',
        'machine_id',
        'user_id',
        'count',
        'defected',
        'status',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
