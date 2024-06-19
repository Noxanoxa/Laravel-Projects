<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',
        'parent',
        'Ordering',
        'Visibility',
        'Allow_Comment',
        'Allow_Ads',
        'status',
    ];
}
