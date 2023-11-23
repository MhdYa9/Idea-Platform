<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\feedController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/',[DashboardController::class,'index'])->middleware('auth')->name('dashboard');
Route::get('/search{flag}',[DashboardController::class,'search'])->name('idea.search');


//laravel have many naming convention and if u want to create many routes which follow the naming convention of laravel
//u can add this line of code
//and that's it everything
//it will include the 7 routes determained by laravel however if u want ot exclude some u can add except

Route::resource('/users',UserController::class)->middleware('auth')->except('index','create','store');
Route::get('/feed',feedController::class)->middleware('auth')->name('feed');
Route::post('/users/{user}/follow',[UserController::class,'follow'])->middleware('auth')->name('users.follow');
Route::post('/users/{user}/unfollow',[UserController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('/idea/{idea}/comment',[CommentController::class,'store'])->middleware('auth')->name('idea.comments.store');
Route::delete('/comment/{comment}/delete',[CommentController::class,'delete'])->middleware('auth','can:admin')->name('comment.delete');

Route::get('/terms',[TermsController::class,'index'])->name('terms')->middleware('auth');

Route::get('/admin',[AdminController::class,'index'])->middleware(['auth','can:admin'])->name('admin.Dashboard');
//instead of making a middlware for admin, we can use can middlware like this can::admin after defining a get in the providers
