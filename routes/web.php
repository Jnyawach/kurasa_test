<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ManageTaskController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\SupermarketController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware'=>['auth']], function (){
    Route::post('supermarket/save',[SupermarketController::class, 'save']);
    Route::resource('/', MainController::class);
    Route::post('user/logout',[AuthController::class, 'destroy'])->name('logout');
});


Route::group(['middleware'=>['guest']],function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('authenticate',[AuthController::class, 'authenticate']);
    Route::post('save/user',[AuthController::class, 'save']);
});





