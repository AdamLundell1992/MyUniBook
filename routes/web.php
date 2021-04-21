<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

//messages
Route::get('messages/index',[\App\Http\Controllers\MessageController::class,'index'])->name('messages/index');
Route::get('messages/message/{id}',[\App\Http\Controllers\MessageController::class,'getMessage'])->name('message');
Route::post('messages/message', [\App\Http\Controllers\MessageController::class,'sendMessage']);


Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//user
Route::get('/auth/{user}/edit',[\App\Http\Controllers\updateDetailsController::class,'edit']);
Route::put('/auth/{user}',[\App\Http\Controllers\updateDetailsController::class,'update']);
Route::get('/search',[\App\Http\Controllers\updateDetailsController::class,'search']);
Route::get('/addfriend/{id}/',[\App\Http\Controllers\updateDetailsController::class,'addfriend']);
Route::get('/deleteFriend{id}/',[\App\Http\Controllers\updateDetailsController::class,'deleteFriend']);
Route::get('/showFriendRequest',[\App\Http\Controllers\updateDetailsController::class,'showFriendRequest']);
Route::get('/confirmRequest{id}/',[\App\Http\Controllers\updateDetailsController::class,'confirmRequest']);
Route::get('/deleteRequest{id}/',[\App\Http\Controllers\updateDetailsController::class,'deleteRequest']);
Route::get('/friendsList',[\App\Http\Controllers\updateDetailsController::class,'friendsList']);
Route::get('/unFriend{id}',[\App\Http\Controllers\updateDetailsController::class,'unFriend']);
Route::get('/checkProfile/{id}',[\App\Http\Controllers\updateDetailsController::class,'checkProfile']);


//comments
Route::delete('/comments/', [\App\Http\Controllers\CommentController::class, 'destroy'])->name("delete_comment");
Route::post('/posts/{post}',[\App\Http\Controllers\CommentController::class,'store']);
//posts
Route::get('/home',[\App\Http\Controllers\PostController::class,'index'])->name('home');
Route::put('/posts/{post}', [\App\Http\Controllers\PostController::class,'update']);
Route::get('/posts/{post}/edit',[\App\Http\Controllers\PostController::class,'edit']);
Route::delete('/posts/{post}/destroy', [\App\Http\Controllers\PostController::class,'destroy']);
Route::post('/posts',[\App\Http\Controllers\PostController::class,'store']);
Route::get('/posts/create',[\App\Http\Controllers\PostController::class,'create']);


