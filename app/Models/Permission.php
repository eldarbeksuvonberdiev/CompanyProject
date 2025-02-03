<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'permission_group_id',
        'name',
        'path',
        'status',
    ];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
