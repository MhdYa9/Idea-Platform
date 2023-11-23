<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//u have to add this file to routers providers in providers file

Route::group(['middleware'=>'guest'],function(){
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'store']);
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'authenticate']);
    Route::get('/logout',[AuthController::class,'logout'])->withoutMiddleware('guest')->middleware('auth')->name('logout');
});
?>
