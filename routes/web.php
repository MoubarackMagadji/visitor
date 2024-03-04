<?php

use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\EmployeeController;

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
    Route::post('/depts', [DeptController::class, 'store'])->name('depts.store');
    Route::get('/dept/{dept}', [DeptController::class, 'edit'])->name('dept.edit');
    Route::post('/dept/{dept}', [DeptController::class, 'update'])->name('dept.update');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

    Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employee/{employee}/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/{employee}/visits', [EmployeeController::class, 'visits'])->name('employee.visits');


    Route::get('/visits', [VisitController::class, 'index'])->name('viewVisits');
    Route::get('/visit/add', [VisitController::class, 'create'])->name('addVisit');
    Route::post('/visit/add', [VisitController::class, 'store'])->name('addVisitPost');
    Route::get('/visit/{visit}', [VisitController::class, 'show'])->name('visitView');
    Route::post('/visit/end', [VisitController::class, 'endVisit'])->name('visitEnd');

    Route::get('/users', [User::class, 'index'])->name('users');

    Route::prefix('user')->group(function(){
        Route::get('/create', [User::class, 'create'])->name('user.add');
        Route::post('/store', [User::class, 'store'])->name('user.store');
        Route::get('/{user}/show', [User::class, 'show'])->name('user.show');
        Route::post('/{user}/update', [User::class, 'update'])->name('user.update');
    });

});
