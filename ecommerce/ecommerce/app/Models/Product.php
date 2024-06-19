<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'code',
        'title',
        'description',
        'price',
        'retail_price',
        'quantity',
        'wilaya',
        'category',
        'user_id',
        'phone',
        'brand',
        'size',
        'status',
        'Visibility',
        'date',
        'main_image',
        'images',
    ];

    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'name');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // public function images()
    // {
    // return $this->hasMany('App\Models\Image', 'product_id');
    // }
}
