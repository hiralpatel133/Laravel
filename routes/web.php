<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\postCommentController;
use App\Http\Controllers\postController;
use App\Http\Controllers\postTagController;
use App\Http\Controllers\userCommentController;
use App\Http\Controllers\userController;

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

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::resource('posts', postController::class);
Route::get('post/tag/{id}', [postTagController::class,'index']);
Route::post('post/comment/{post}',[postCommentController::class,'store'])->middleware('auth');
Route::get('post/{post}/comment',[postCommentController::class,'index']);

Route::resource('users', userController::class)->only(['show', 'edit', 'update'])->middleware('auth');
Route::resource('users.comments', userCommentController::class)->only(['store']);

