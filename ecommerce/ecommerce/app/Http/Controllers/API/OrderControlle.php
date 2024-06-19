<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orderitems;
use Illuminate\Http\Request;

class OrderControlle extends Controller
{
    //

    public function index() {
        $orders = Orderitems::all();

        return response()->json([
            'status' => 200,
            'orders' => $orders,
        ]);
    }
}
