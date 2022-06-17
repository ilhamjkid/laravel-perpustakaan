<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('/grade', GradeController::class);
Route::get('/sluggrade', [GradeController::class, 'checkSlug']);

Route::resource('/category', CategoryController::class);
Route::get('/slugcategory', [CategoryController::class, 'checkslug']);

Route::resource('/book', BookController::class);
Route::get('/slugbook', [BookController::class, 'checkslug']);

Route::resource('/borrower', BorrowerController::class);
Route::get('/slugborrower', [BorrowerController::class, 'checkslug']);

Route::resource('/history', HistoryController::class);
Route::get('/report', [HistoryController::class, 'report']);

Route::resource('/user', UserController::class)->middleware('auth');
