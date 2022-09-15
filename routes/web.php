<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;

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
Route::post('/blogs/store', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/edit/{id}', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
Route::post('/blogs/update/{id}', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');

Route::post('/change-status', [App\Http\Controllers\CommonController::class, 'changeStatus'])->name('change-status');



/** Author route */
Route::get('/author', [App\Http\Controllers\AuthorController::class, 'index'])->name('author');
Route::get('/author/create', [App\Http\Controllers\AuthorController::class, 'create'])->name('author.create');
Route::post('/author/store', [App\Http\Controllers\AuthorController::class, 'store'])->name('author.store');
Route::get('/author/edit/{id}', [App\Http\Controllers\AuthorController::class, 'edit'])->name('author.edit');
Route::post('/author/update/{id}', [App\Http\Controllers\AuthorController::class, 'update'])->name('author.update');



/** Category route */
// Route::get('/author', [App\Http\Controllers\AuthorController::class, 'index'])->name('author');
// Route::get('/author/create', [App\Http\Controllers\AuthorController::class, 'create'])->name('author.create');
// Route::post('/author/store', [App\Http\Controllers\AuthorController::class, 'store'])->name('author.store');
// Route::get('/author/edit/{id}', [App\Http\Controllers\AuthorController::class, 'edit'])->name('author.edit');
// Route::post('/author/update/{id}', [App\Http\Controllers\AuthorController::class, 'update'])->name('author.update');
