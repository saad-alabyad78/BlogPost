<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminLogController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminPasswordController;
use App\Http\Controllers\Admin\AdminRegisterController;

Route::group([
    'middleware' => ['role:admin'] ,
    'prefix' => 'admin' ,
    'as' => 'admin.' ,
] , function() 
{
    Route::get('' , [AdminPostController::class , 'index'])->name('home');

    Route::group([
        'prefix'=>'register' ,
        'middleware'=>['guest'] ,
        ] , function(){
        Route::get('' , [AdminRegisterController::class , 'show'])->name('register');
        Route::post('', [AdminRegisterController::class, 'store']);
    });

    Route::get('login', [AdminLogController::class, 'show'])->name('login');
    Route::post('login', [AdminLogController::class, 'login']);
    
    Route::post('logout' , [AdminLogController::class , 'logout'])
        ->name('logout')
        ->middleware('auth');

    Route::prefix('password')->group(function(){
        Route::get('reset', [AdminPasswordController::class, 'showForgetForm'])->name('password.forget');
        Route::post('email', [AdminPasswordController::class, 'sendResetEmail'])->name('password.email');
        Route::get('reset/{token}', [AdminPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset', [AdminPasswordController::class, 'reset'])->name('password.update');
    });
    
    Route::get('post/{post}/users' , [AdminPostController::class , 'showUsers'])->name('post.users');
    Route::post('post/{post}/addUser/{user}' , [AdminPostController::class , 'addUserToPost'])->name('post.addUser');
    Route::delete('post/{post}/removeUser/{user}' , [AdminPostController::class , 'removeUserFromPost'])->name('post.removeUser');

    Route::delete('post/{post}' , [PostController::class , 'destroy'])->name('post.delete');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});
