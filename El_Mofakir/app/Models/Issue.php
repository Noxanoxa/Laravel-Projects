<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['issue_number', 'issue_date', 'volume_id'];

    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

/*    public function scopeSearch($query, $keyword)
    {
        return $query->where('number', 'like', '%' . $keyword . '%')
                     ->orWhere('date', 'like', '%' . $keyword . '%');
    }*/
    /*public function status()
    {
        return $this->status == 1 ? __('Backend/Issues.active') : __('Backend/Issues.inactive');
    }*/


}
