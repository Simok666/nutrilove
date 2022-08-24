<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingGiziController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ArticleController;

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
    return view('user.index');
});


Route::get('/admin/blank', function () {
    return view('admin/admin');
});
Route::middleware('guest')->group(function () { 
Route::get('/admin/users', [UserController::class,'index'])->name('user.index');
Route::get('/dashboard', [UserController::class,'index'])->name('admin.index');
Route::get('/content', [AdminController::class,'ajaxContent'])->name('admin.content');

Route::post('/showtable/{table}',[AdminController::class,'showtables'])->name('tables') ;
Route::post('/save/{table}',[AdminController::class,'save']);
Route::post('/delete/{table}',[AdminController::class,'delete']);
Route::post('/detail/{table}',[AdminController::class,'detail']);


Route::post('/users/upsert/',[UserController::class,'upsert']);
Route::post('/admin/contentupsert/',[AdminController::class,'contentUpsert']);

Route::get('/admin/content',[ContentController::class,'index'])->name('content');
Route::get('admin/content/form',[ContentController::class,'form'])->name('content.form');
Route::post('admin/content/upsert',[ContentController::class,'upsert'])->name('content.upsert');

Route::get('/admin/article',[ArticleController::class,'index'])->name('article');
Route::get('admin/article/form',[ArticleController::class,'form'])->name('article.form');
Route::post('admin/article/upsert',[ArticleController::class,'upsert'])->name('article.upsert');

Route::get('/admin/article/kategori',[ArticleController::class,'category'])->name('article_category');
Route::post('/admin/article/kategori',[ArticleController::class,'category'])->name('article_category');
Route::post('admin/article/kategori/upsert',[ArticleController::class,'category_upsert'])->name('article_category.upsert');

route::get('admin/setting/gizi', [SettingGiziController::class, 'index'])->name('setting.gizi');
route::post('admin/setting/gizi/upsert', [SettingGiziController::class, 'upsert'])->name('setting.gizi.upsert');
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

require __DIR__.'/auth.php';
