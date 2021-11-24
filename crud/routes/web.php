<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PostController;
Route::get('/', [PostController::class, 'index']);
Route::get('/search', [PostController::class, 'search']);
Route::delete('/deleteall', [PostController::class, 'deleteAll']);
Route::resource('posts', '\App\Http\Controllers\PostController');
