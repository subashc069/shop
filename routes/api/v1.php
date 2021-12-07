<?php
declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })->name('auth:me');

/**
 * Product Routes
 */
Route::prefix('products')->as('products:')->group(function () {
    Route::get(
        '/',
        App\Http\Controllers\Api\V1\Products\IndexController::class,
    )->name('index');

    Route::get(
        '{key}',
        App\Http\Controllers\Api\V1\Products\ShowController::class,
    )->name('show');
});

/**
 * cart routes
 */

Route::prefix('carts')->as('carts:')->group(function () {
    /**
     * Get the users cart
     */
    Route::get('/', App\Http\Controllers\Api\V1\Carts\IndexController::class)
       ->name('index');

    /**
     * Create new cart
     */
    Route::post('/', App\Http\Controllers\Api\V1\Carts\StoreController::class)
        ->name('store');

    /**
     * Add product to cart
     */
    Route::post('{cart:uuid}/products', App\Http\Controllers\Api\V1\Carts\Products\StoreController::class)
        ->name('products:store');

    /**
     * Update Quantity
     */
    Route::patch('{cart:uuid}/products/{item:uuid}', App\Http\Controllers\Api\V1\Carts\Products\UpdateController::class)
        ->name('products:update');

    /**
     * Delete Product
     */
    Route::delete('{cart:uuid}/products/{item:uuid}', App\Http\Controllers\Api\V1\Carts\Products\DeleteController::class)
        ->name('products:delete');

    /**
     * Store Coupons
     */

    Route::post('{cart:uuid}/coupons', \App\Http\Controllers\Api\V1\Carts\Coupons\StoreController::class)
        ->name('coupons:store');

});
