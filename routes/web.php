<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//books::read
Route::get('/books', [BookController::class ,'index'])->name('books');
Route::get('/books/show/{id}', [BookController::class ,'show'])->name('books.show');

//books::create
Route::get('/books/create', [BookController::class ,'create'])->name('books.create');
Route::post('/books/store', [BookController::class ,'store'])->name('books.store');

//books::update
Route::get('/books/edit/{id}', [BookController::class ,'edit'])->name('books.edit');
Route::post('/books/update/{id}', [BookController::class ,'update'])->name('books.update');

//books::delete
Route::get('/books/delete/{id}', [BookController::class ,'delete'])->name('books.delete');


//cats::read
Route::get('/cats', [CatController::class ,'index'])->name('cats');
Route::get('/cats/show/{id}', [CatController::class ,'show'])->name('cats.show');

//cats::create
Route::get('/cats/create', [CatController::class ,'create'])->name('cats.create');
Route::post('/cats/store', [CatController::class ,'store'])->name('cats.store');

//cats::update
Route::get('/cats/edit/{id}', [CatController::class ,'edit'])->name('cats.edit');
Route::post('/cats/update/{id}', [CatController::class ,'update'])->name('cats.update');

//cats::delete
Route::get('/cats/delete/{id}', [CatController::class ,'delete'])->name('cats.delete');
