<?php

// use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\API\OrderControlle;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\FrontendController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Category And Products :

Route::get('getCategory', [FrontendController::class, 'category']);
Route::get('fetchProducts/{categoryName}', [FrontendController::class, 'product']);
Route::get('viewproductdetail/{categoryName}/{id}', [FrontendController::class, 'viewproduct']);

// Cart And Products :

Route::post('add-to-cart', [CartController::class, 'addtocart']);
Route::get('cart', [CartController::class, 'viewcart']);
Route::put('cart-updatequantity/{cart_id}/{scope}', [CartController::class, 'updatequantity']);
Route::delete('delete-cartitem/{cart_id}', [CartController::class, 'deletecartitem']);

// Checkout And Orders And Pay Online :

Route::post('validate-order', [CheckoutController::class, 'Validateorder']);
Route::post('place-order', [CheckoutController::class, 'placeorder']);

// Admin Route :

Route::middleware(['auth:sanctum','isAPIAdmin'] )->group(function () {
    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message'=> 'You Are In', 'status'=>200], 200);
    });


// Category :

    Route::post('category', [CategoryController::class, 'store']);
    Route::get('view-category', [CategoryController::class, 'index']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('all-category', [CategoryController::class, 'allCategory']);

// Orders :

    Route::get('admin/orders', [OrderControlle::class, 'index']);

// products :

    Route::post('store-product', [ProductController::class, 'store']);
    Route::get('view-product', [ProductController::class, 'index']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('update-product/{id}', [ProductController::class, 'update']);

});

// Logout :

Route::middleware(['auth:sanctum'] )->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

// Authantication :

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
