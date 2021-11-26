<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name(name: 'auth:me');

/**
 * Product Routes
 */
Route::prefix('products')->as('products:')->group(function () {
    Route::get(
        uri: '/',
        action: App\Http\Controllers\Api\V1\Products\IndexController::class,
    )->name(name: 'show');
});
