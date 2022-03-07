<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->name('api')->group(function() {
    Route::prefix('/products')->group(function() {
       Route::get('/', [ProductController::class, 'index'])->name('index');
       Route::get('/{id}', [ProductController::class, 'show'])->name('show');
       Route::post('/', [ProductController::class, 'store'])->name('store');
       Route::put('/{id}', [ProductController::class, 'update'])->name('update');
       Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
    });

});
