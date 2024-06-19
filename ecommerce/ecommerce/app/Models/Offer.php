<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'salary',
        'company_name',
        'contact_email',
        'contact_phone',
        'posted_date',
    ];
    public function offer() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}




