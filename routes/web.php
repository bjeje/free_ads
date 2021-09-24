<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/', [\App\Http\Controllers\IndexController::class, 'showIndex'])->name('test');
Route::get('/error', [App\Http\Controllers\errorController::class, 'show'])->name('error');
Route::get('/verify',[RegisterController::class , 'verifyUser'])->name('verify.user');

//Route::get('/home', [App\Http\Controllers\ArticleController::class, 'index'])->name('home');

Route::get('/user/edit-profil', [App\Http\Controllers\UserController::class, 'edit'])->name('edit-profil');
Route::get('/user/delete-profil', [App\Http\Controllers\UserController::class, 'deleteProfil'])->name('delete-profil');

Route::resource('/user', App\Http\Controllers\UserController::class);
Route::resource('/home', App\Http\Controllers\ArticleController::class);
Route::get('/search', [App\Http\Controllers\ArticleController::class, 'searchArticle'])->name('searchArticle');
