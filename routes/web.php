<?php

use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptController;

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
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [User::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [User::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', [User::class, 'logout'])->name('logout')->middleware('auth');

Route::get('dashboard', [User::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function(){

    Route::get('/depts', [DeptController::class, 'index'])->name('depts');

});
