<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/ideas/', 'as'=>'idea.'],function(){
    //you can add route groups inside a route group
    Route::post('',[IdeaController::class,'store'])->middleware('auth')->name('create');
    Route::get('{idea}',[IdeaController::class,'show'])->middleware('auth')->name('show');
    Route::get('{idea}/edit',[IdeaController::class,'edit'])->middleware('auth')->name('edit');
    Route::put('{idea}',[IdeaController::class,'update'])->middleware('auth')->name('update');
    Route::delete('{idea}',[IdeaController::class,'destroy'])->middleware('auth')->name('destroy');
    Route::post('{idea}/like',[UserController::class,'like'])->middleware('auth')->name('like');
    Route::post('{idea}/unlike',[UserController::class,'unlike'])->middleware('auth')->name('unlike');

    //u can add ->middleware('auth') which will prevent any one who doesn't own the idea to tamper with it
});


?>
