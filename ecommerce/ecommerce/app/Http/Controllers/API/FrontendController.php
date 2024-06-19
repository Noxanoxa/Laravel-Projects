<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    //

    public function category() {
        $category = Category::where('Visibility', '0')->get();
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }

    public function product($categoryName) {
        $category = Category::where('name', $categoryName)->where('Visibility', '0')->first();
        if($category)
        {

            $product = Product::where('category', $category->id)->where('Visibility', '0')->get() ;

            if($product)
            return response()->json([
            'status' => 200,
            'product_data' => [
                'product' => $product,
                'category' => $category,
            ],
            ]);
            else
            return response()->json([
                'status' => 400,
                'message' => 'No Product Available',
                ]);
    }
        else
        return response()->json([
            'status' => 404,
            'message' => 'No Such Category Found',
        ]);
    }

    public function viewproduct($productCategory, $id) {

        $category = Category::where('name', $productCategory)->first();
        if($category)
        {

            $product = Product::where('category', $category->id)
                                ->where('id', $id)
                                ->where('Visibility', '0')
                                ->first();

            $user = User::where('id', $product->user_id)->first();

            if($product)
            return response()->json([
            'status' => 200,
                'product' => $product,
                'category' => $category->name,
                'user' => $user,
            ]);
            else
            return response()->json([
                'status' => 400,
                'message' => 'No Product Available',
            'category' => $category->name,
                ]);
    }
        else
        return response()->json([
            'status' => 404,
            'message' => 'No Such Category Found',
            'category' => $category->name,
        ]);    }

}
