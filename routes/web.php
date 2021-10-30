<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPajakController;
use App\Http\Controllers\DashboardKategoriController;
use App\Http\Controllers\DashboardItemController;



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
    return view('home',['_posisi' => 'home', '_title' => 'Home']);
});

Route::get('/contact', function () {
    return view('contact',['_posisi' => 'contact', '_title' => 'contact']);
});

Route::get('/product', [ItemController::class, 'index']);
Route::get('/product/{Item:slug}', [ItemController::class, 'show']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/dashboard', function(){ return view('dashboard.index'); } )->middleware('auth');
Route::get('/dashboard/orders', function(){ return view('dashboard.index'); } )->middleware('auth');
Route::get('/dashboard/reportsales', function(){ return view('dashboard.index'); } )->middleware('auth');


Route::get('/dashboard/kategori/checkSlug', [DashboardKategoriController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/kategori', DashboardKategoriController::class)->middleware('auth');

Route::get('/dashboard/pajak/checkSlug', [DashboardPajakController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/pajak', DashboardPajakController::class)->middleware('auth');

Route::get('/dashboard/item/checkSlug', [DashboardItemController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/item', DashboardItemController::class)->middleware('auth');