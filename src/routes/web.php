<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;

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

Route::get('/', [ItemController::class, 'index']);
Route::post('/sell', [ItemController::class, 'store']);
Route::get('/sell', [ItemController::class, 'sell']);
Route::get('/mypage', [ItemController::class, 'mypage']);
Route::get('/mypage/profile', [ItemController::class, 'profile']);
Route::post('/',[ItemController::class,'updateProfile']);

Route::middleware('auth')->get('/redirect-after-login', function () {

    if (!auth()->user()->profile_completed) {
        return redirect('mypage/profile');
    }

    return redirect('/');
});
