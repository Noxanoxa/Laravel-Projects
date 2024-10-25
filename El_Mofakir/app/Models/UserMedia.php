<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMedia extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->blengsTo(User::class);
    }
}
