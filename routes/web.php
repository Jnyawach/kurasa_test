<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageTaskController;
use App\Http\Controllers\SubTaskController;
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
    Route::patch('sub_tasks/trash/{id}',[SubTaskController::class,'trashTask']);
    Route::patch('sub_tasks/complete/{id}',[SubTaskController::class,'completeTask']);
    Route::patch('sub_tasks/cancel/{id}',[SubTaskController::class,'cancelTask']);
    Route::resource('sub_tasks',SubTaskController::class);
    Route::resource('/', TaskController::class);
    Route::patch('tasks/trash/{id}',[ManageTaskController::class,'trashTask']);
    Route::patch('tasks/complete/{id}',[ManageTaskController::class,'completeTask']);
    Route::patch('tasks/cancel/{id}',[ManageTaskController::class,'cancelTask']);
    Route::resource('tasks',ManageTaskController::class);
    Route::post('user/logout',[AuthController::class, 'destroy'])->name('logout');
});


Route::group(['middleware'=>['guest']],function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('authenticate',[AuthController::class, 'authenticate']);
    Route::post('save/user',[AuthController::class, 'save']);
});





