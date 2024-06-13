<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterUserController;

Route::group([
    'prefix'=>'register' ,
    'middleware'=>['guest'] ,
    ] , function(){
    Route::get('' , [RegisterUserController::class , 'show'])->name('register');
    Route::post('', [RegisterUserController::class, 'store']);
});

Route::get('login', [LogController::class, 'show'])->name('login');
Route::post('login', [LogController::class, 'login']);

Route::post('logout' , [LogController::class , 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::prefix('password')->group(function(){
    Route::get('reset', [PasswordController::class, 'showForgetForm'])->name('password.forget');
    Route::post('email', [PasswordController::class, 'sendResetEmail'])->name('password.email');
    Route::get('reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset', [PasswordController::class, 'reset'])->name('password.update');
});

Route::get('/', [PostController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'post' ,
    'middleware' => ['auth'] ,
    'as' => 'posts.' ,
] , function(){
    Route::post('' , [PostController::class , 'store'])->name('store') ;
    Route::delete('' , [PostController::class , 'destroy'])->name('delete') ;
    Route::put('' , [PostController::class , 'update'])->name('update') ;

    Route::get('create' , [PostController::class , 'create'])->name('create');
    Route::get('edit' , [PostController::class , 'edit'])->name('edit');
}) ;

