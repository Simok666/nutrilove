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


Route::get('/admin/blank', function () {
    return view('admin/admin');
});

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