<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\User;
use Illuminate\Support\Facades\Input;

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

Route::get('/',[ArticleController::class,"index"]);

Route::get("/articles",[ArticleController::class, "index"]);

Route::get("/articles/detail/{id}",[
    ArticleController::class,"detail"
]);

Route::get('/articles/add', [ArticleController::class, "add"])->middleware('auth');

Route::post('/articles/add', [
    ArticleController::class,"create"
]);

Route::get("/articles/delete/{id}", [
    ArticleController::class,"delete"
]);

Route::post("/comments/add", [
    CommentController::class,
    "create"
]);

Route::get('/comments/delete/{id}', [
    CommentController::class,
    "delete"
]);

Route::post('/home', [
    HomeController::class,
    "upload"
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
