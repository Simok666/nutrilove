<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;

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


Route::get('/admin/blank', function () {
    return view('admin/admin');
});

Route::get('/admin/users', [UserController::class,'index'])->name('user.index');
Route::get('/content', [AdminController::class,'ajaxContent'])->name('admin.content');

Route::get('/admin/content',[AdminController::class,'showContent'])->name('content');
Route::post('/showtable/{table}',[AdminController::class,'showtables'])->name('tables') ;
Route::post('/save/{table}',[AdminController::class,'save']);
Route::post('/delete/{table}',[AdminController::class,'delete']);
Route::post('/detail/{table}',[AdminController::class,'detail']);


Route::post('/users/upsert/',[UserController::class,'upsert']);
Route::post('/admin/contentupsert/',[AdminController::class,'contentUpsert']);

Route::get('/index', function () {
    return view('user.index');
})->name('users.index');

Route::get('/aboutus', function () {
    return view('user.aboutus');
})->name('users.aboutus');

Route::get('/articles', function () {
    return view('user.blog');
})->name('users.blogs');

Route::get('/single-articles', function () {
    return view('user.single_blog');
})->name('users.singleblogs');