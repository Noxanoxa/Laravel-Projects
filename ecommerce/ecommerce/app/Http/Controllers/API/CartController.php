<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //

    public function addtocart(Request $request) {

        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;

            $productCheck = Product::where('id', $product_id)->first();
            if($productCheck)
            {
                if(Cart::where('product_id', $productCheck)->where('user_id', $user_id)->exists())
                return response()->json([
                    'status' => 409,
                    'message' => $productCheck->naem .'Already Added To Cart',
                ]);

            else
            {
                $cartitem = new Cart;
                $cartitem->user_id = $user_id;
                $cartitem->product_id = $product_id;
                $cartitem->product_qty = $product_qty;
                $cartitem->save();

                return response()->json([
                    'status' => 201,
                    'message' => 'Added To Cart Successfully',
                ]);

            }
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Such Product For This Id',
                ]);
            }


        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login To Add To Cart',
            ]);
        }
    }

    public function viewcart() {
        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitems = Cart::where('user_id', $user_id)->get();
            return response()->json([
                'status' => 200,
                'cart' => $cartitems,
            ]);

        }
        else
        return response()->json([
            'status' => 401,
            'message' => 'Login To View Cart Data ',
        ]);

    }

    public function updatequantity($cart_id, $scope) {

        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitems = Cart::where('id', $cart_id)->where('user_id', $user_id )->first();
            if($scope == 'inc')
            $cartitems->product_qty += 1;
            else if($scope == 'dec')
            $cartitems->product_qty -=1;

            $cartitems->update();

            return response()->json([
                'status' => 200,
                'message' => 'Quantity Updated',
            ]);


        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login To Add To Cart',
            ]);
        }


    }

    public function deletecartitem($cart_id) {

        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitems = Cart::where('id', $cart_id)->where('user_id', $user_id )->first();

            if($cartitems)
            {

                $cartitems->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Cart Item Deleted Successfully',
                ]);

            }
            else

            return response()->json([
                'status' => 404,
                'message' => 'Cart Item Not Found',
            ]);


        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login To Add To Cart',
            ]);
        }



    }
}

