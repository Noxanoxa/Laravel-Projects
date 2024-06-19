<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        // 'user_id',
        // 'firstname',
        // 'lastname',
        // 'phone',
        // 'email',
        // 'address',
        // 'city',
        // 'state',
        // '',
        // 'payment_id',
        // 'payment_mode',
        // 'tracking_no',
        // 'status',
        // 'remark',

        'firstname ',
        'lastname ',
        'address ',
        'appartment ',
        'city ',
        'postalcode ',
        'phone ',
        'shippingcompany',
        'shippingWilaya',
        'email',
    ];

    public function orderitems() {
        return $this->hasMany(Orderitems::class, 'order_id', 'id');
    }

}
