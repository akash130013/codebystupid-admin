<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     // return view('welcome');
//     // return redirect(route('/login'));
//     Route::redirect('/here', '/there');
// });

Route::redirect('/', '/login');


Auth::routes();
//this is a test 1222
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/** Blogs route */
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
