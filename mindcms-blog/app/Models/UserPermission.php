<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public  function permissions()
    {
        return $this->belongsToMany(Permission::class, 'id', 'permission_id');
    }
    public  function user()
    {
        return $this->belongsToMany(Permission::class, 'id', 'user_id');
    }
}
