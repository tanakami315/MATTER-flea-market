<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/mypage', [UserController::class, 'showMypage']);
Route::get('/mypage/profile', [UserController::class, 'showProfile']);
Route::post('/',[UserController::class,'updateProfile']);

Route::get('/', [ItemController::class, 'index']);
Route::get('/sell', [ItemController::class, 'sell']);
Route::post('/sell', [ItemController::class, 'store']);
Route::get('/item/{item_id}', [ItemController::class, 'showDetail']);
Route::get('/purchase/{item_id}', [ItemController::class, 'choose']);
Route::post('/purchase/{item_id}', [ItemController::class, 'choose']);
Route::get('/purchase/address/{item_id}', [ItemController::class, 'editAddress']);
Route::post('/purchase/address/{item_id}', [ItemController::class, 'updateAddress']);
Route::get('/purchase/finish/{item_id}', [ItemController::class, 'purchase']);
Route::post('/purchase/finish/{item_id}', [ItemController::class, 'purchase']);

Route::post('/item/{item_id}/like', [ItemController::class, 'like']);
Route::delete('/item/{item_id}/like', [ItemController::class, 'unlike']);

Route::get('/item/{item_id}', [CommentController::class, 'showComments']);
Route::post('/item/{item_id}/comment', [CommentController::class, 'store']);

Route::middleware('auth')->get('/redirect-after-login', function () {
    if (!auth()->user()->profile_completed) {
        return redirect('mypage/profile');
    }
    return redirect('/');
});
