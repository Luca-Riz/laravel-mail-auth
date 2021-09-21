<?php

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

Route::namespace('Api')->group(function(){
  Route::get('/posts', 'PostController@index');
  Route::get('/post/{slug}', 'PostController@show');

  Route::post('/contacts', 'ContactController@store');
});

//? era scritto cosí, poi é stato raggruppato come si puó vedere qui sopra
// Route::get('/posts', 'Api\PostController@index');
// Route::get('/post/{slug}', 'Api\PostController@show');