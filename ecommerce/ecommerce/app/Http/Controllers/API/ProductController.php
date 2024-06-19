<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{


    public function index() {

        $products = Product::all();
        return response()->json([
            'status' => 200,
            'products' => $products,
        ]);
    }


    // Add Product
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:191',
            'title' => 'required|max:191',
            'wilaya' => 'required|max:191',
            'phone' => 'required|max:191',
            'quantity' => 'required|max:10',
            'price' => 'required|max:20',
            'date' => 'required|max:191',
            'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'required|array',
            'images.*.previewUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validator->fails())
        return response()->json([
            'status' => 422,
            'errors' => $validator->getMessageBag(),
        ]);

        else
        {
        $product = new Product();

        $product->code = $request->input('code');
        $product->title = $request->input('title');
        $product->description = $request->input('description');

        $product->price = $request->input('price');
        $product->retail_price = $request->input('retail_price');

        $product->quantity = $request->input('quantity');
        $product->wilaya = $request->input('wilaya');


        $cat= Str::lower( $request->input('category'));
        $cat= ucfirst( $cat);
        $category = Category::where('name', $cat)->first();
        if (!$category) {
            return response()->json([
                'status' => 404,
                'error' => 'Category not found.',
            ]);
        }
        $product->category =  $category->id;
        $product->phone= $request->input('phone');
        $product->brand= $request->input('brand');
        $product->size = $request->input('size');
        $product->date = $request->input('date');
        // $product->user_id = $request->input('user_id');
        $product->user_id = auth()->user()->id;

        // Get the base64 image data from the request
        $base64Image = $request->input('main_image');
        // Decode the base64 image data and store the image
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        // Generate a unique file name
        $fileName = uniqid() . '.png';
        $product->main_image = $fileName;
        // Specify the storage path where you want to save the image
        $storagePath = 'public/uploads/product/main_image';
        // Store the image on the server
        Storage::put($storagePath . '/' . $fileName, $imageData);


        $imagePaths = [];
        foreach ($request->input('images') as $imageData) {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $fileName = uniqid() . '.png';
        $storagePath = 'public/uploads/product/images';
        Storage::put($storagePath . '/' . $fileName, $imageData);
        $imagePaths[] = $fileName;
        }

        $product->images = json_encode($imagePaths);

        $product->save();

        return response()->json([
            'status' => 200,
            'message' => 'The Product Has Been Added Successfully (:',
        ]);
    }
    }

    public function edit($id) {

        $product = Product::find($id);

        if($product) {
            return response()->json([
                'status' => 200,
                'product' => $product,
        ]);
        }

        else {
            return response()->json([
                'status' => 404,
                'error' => 'No Such Id For This Product',
        ]);
        }
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:191',
            'title' => 'required|max:191',
            'wilaya' => 'required|max:191',
            'phone' => 'required|max:191',
            'quantity' => 'required|max:10',
            'price' => 'required|max:20',
            'date' => 'required|max:191',
            'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'required|array',
            'images.*.previewUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validator->fails())
        return response()->json([
            'status' => 422,
            'errors' => $validator->getMessageBag(),
        ]);

        else
        {
        $product = Product::find($id);

            if($product) {
        $product->code = $request->input('code');
        $product->title = $request->input('title');
        $product->description = $request->input('description');

        $product->price = $request->input('price');
        $product->retail_price = $request->input('retail_price');

        $product->quantity = $request->input('quantity');
        $product->wilaya = $request->input('wilaya');

        $product->category= $request->input('category');
        $product->phone= $request->input('phone');
        $product->brand= $request->input('brand');
        $product->size = $request->input('size');
        $product->date = $request->input('date');
        $product->status = $request->input('status');

        if ($request->has('main_image')) {
            $base64Image = $request->input('main_image');
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
            $fileName = uniqid() . '.png';
            $storagePath = 'public/uploads/product/main_image';
            Storage::put($storagePath . '/' . $fileName, $imageData);

            // Delete the old main image (if it exists)
            if ($product->main_image) {
                Storage::delete($storagePath . '/' . $product->main_image);
            }

            $product->main_image = $fileName;
        }



        if ($request->has('images')) {
            $imagePaths = [];
            foreach ($request->input('images') as $imageData) {
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $fileName = uniqid() . '.png';
                $storagePath = 'public/uploads/product/images';
                Storage::put($storagePath . '/' . $fileName, $imageData);
                $imagePaths[] = $fileName;
            }

            // Delete the old images (if they exist)
            if ($product->images) {
                $oldImagePaths = json_decode($product->images);
                foreach ($oldImagePaths as $oldImagePath) {
                    Storage::delete($storagePath . '/' . $oldImagePath);
                }
            }

            $product->images = json_encode($imagePaths);
        }

        $product->update();

        return response()->json([
            'status' => 200,
            'message' => 'The Product Has Been Added Successfully (:',
            // 'productid'=> $product->id,
        ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'The Product Not Found',
            ]);
            }
        }
    }
    }

