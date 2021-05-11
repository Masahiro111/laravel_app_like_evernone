<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.index');

Route::get('/user', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('user.register');

Route::post('/user/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('user.exec.register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/memo', function () {
        return view("memo");
    })->name('memo.index');
});
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/memo', 'MemoController@index')->name('memo.index');
