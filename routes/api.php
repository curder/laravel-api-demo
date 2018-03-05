<?php

use Illuminate\Http\Request;

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

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );

Route::ApiResource( '/products', 'ProductController' );
Route::group( [ 'prefix' => 'products' ], function () {
	Route::apiResource( '/{product}/reviews', 'ReviewController' );
} );
Route::ApiResource( '/lessons', 'LessonController' );
Route::ApiResource( '/tags', 'TagsController' )->only( [ 'index', 'show' ] );
Route::get( 'lesson/{id}/tags', 'TagsController@index' );



