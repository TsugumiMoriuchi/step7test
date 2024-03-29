<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class, 'indexhome'])->name('home');
Route::get('/search', [ProductController::class, 'search'])->name('search');//検索
Route::get('/list', [ProductController::class, 'list'])->name('list');//一覧画面表示
Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');//詳細画面表示
Route::get('/create', [ProductController::class, 'showRegistForm'])->name('create');//新規登録画面表示
Route::post('/create', [ProductController::class, 'createSubmit'])->name('createSubmit');//新規登録処理
Route::get('/edit/{id}', [ProductController::class, 'showEdit'])->name('edit');//編集画面表示
Route::post('/edit/{id}', [ProductController::class, 'createEdit'])->name('editSubmit');//更新処理
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');//削除処理
// Route::get('/sort', [ProductController::class, 'sort'])->name('sort');//ソート機能


Auth::routes();

Route::get('/home', [HomeController::class, 'indexhome'])->name('home');
