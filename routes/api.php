<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::ApiResource('/products', ProductController::class);
Route::group(['prefix' => 'products'], function () {
    Route::apiResource('/{product}/reviews', ReviewController::class);
});
Route::ApiResource('/lessons', LessonController::class);
Route::ApiResource('/tags', TagsController::class)->only(['index', 'show']);
Route::get('lesson/{id}/tags', [TagsController::class, 'index']);
