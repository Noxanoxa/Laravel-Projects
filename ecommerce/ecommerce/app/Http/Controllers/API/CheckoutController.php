<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function placeorder(Request $request) {

        if(auth('sanctum')->check())
        {
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|max:191',
                'lastname'  => 'required|max:191',
                'phone'     => 'required|max:191',
                'email'     => 'required|max:191',
                // 'address'   => 'required|max:191',
                // 'city'      => 'required|max:191',
                // 'status'    => 'required|max:191',
                // 'zipcode'   => 'required|max:191',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->getMessageBag(),
                ]);
            }
            else
            {
                $order = new Order;

                $order->user_id =auth('sanctum')->user()->id ;
                $user_id = auth('sanctum')->user()->id;

                // $order->firstname = $request->input('firstname');
                // $order->lastname = $request->input('lastname');
                // $order->phone = $request->input('phone');
                // $order->email = $request->input('email');
                // $order->address = $request->input('address');
                // $order->city = $request->input('city');
                // $order->status = $request->input('status');
                // $order->zipcode = $request->input('zipcode');

                // $order->payment_id = $request->input('payment_id');
                // $order->payment_mode = $request->input('payment_mode');
                // $order->tracking_no = 'xano'.rand(1111,9999);

                $order->firstname = $request->firstname;
                $order->lastname  =  $request->lastname;
                $order->phone     =     $request->phone;
                $order->email     =     $request->email;
                $order->address   =   $request->address;
                $order->city      =      $request->city;
                $order->status    =    $request->status;
                $order->appartment   =   $request->appartment;
                $order->postalcode   =   $request->postalcode;
                $order->shippingcompany   =   $request->shippingcompany;
                $order->shippingWilaya   =   $request->shippingWilaya;


                // $order->payment_id = $request->  payment_id;
                // $order->payment_mode = $request->payment_mode;
                // $order->tracking_no = 'xano'.rand(1111,9999);

                $order->save();

                $cart = Cart::where('user_id', $user_id)->get();

                $orderitems = [];

                foreach($cart as $item)
                {
                    $orderitems [] = [
                        'product_id' => $item->product_id,
                        'quantity' => $item->product_qty,
                        'price' => $item->product->price,
                    ];

                    $item->product->update([
                        'quantity' => $item->product->quantity - $item->product_qty,
                    ]);
                }
                // i use function in model Order to make relationship with orderitems
                $order->orderitems()->createMany($orderitems);


                //now i wanna to empty the cart
                Cart::destroy($cart);

                return response()->json([
                    'status' => 200,
                    'message' => 'Order Placed Successfully',
                ]);

            }

        }
        else

        return response()->json([
            'status' => 401,
            'message' => 'Login To Continue...'
        ]);
    }

    public function Validateorder(Request $request) {
        if(auth('sanctum')->check())
        {
            $validtor = Validator::make($request->all(), [
                'firstname' => 'required|max:191',
                'lastname'  => 'required|max:191',
                'phone'     => 'required|max:191',
                'email'     => 'required|max:191',
                'address'   => 'required|max:191',
                'city'      => 'required|max:191',
                'status'    => 'required|max:191',
                'zipcode'   => 'required|max:191',
            ]);

            if(validator()->fails())
            {
                return response()->json([
                    'status' => 422,
                    'errors' => $validtor->getMessageBag(),
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Form Validated Successfully',
                ]);
            }

        }
        else

        return response()->json([
            'status' => 401,
            'message' => 'Login To Continue...'
        ]);

    }
}
