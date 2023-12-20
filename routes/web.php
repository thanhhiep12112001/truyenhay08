<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\GenreController;


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

Route::get ('/', [IndexController::class,"home"]);
Route::get ('/category/{slug}', [IndexController::class,'category']);
Route::get ('/doc-truyen/{id}', [IndexController::class,'doctruyen']);
Route::get ('/story/{id}', [IndexController::class,'story']);
Route::get ('/xem-chapter/{slug}', [IndexController::class,'xemchapter']);
Route::get ('/genre/{slug}', [IndexController::class,'genre']);
Route::get ('/tim-kiem', [IndexController::class,'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class,'timkiem_ajax']);

Route::get('/tag/{tag}', [IndexController::class,'tag']);
Route::get('/favorite-stories',[IndexController::class,'showFavoriteStories'])->name('favorite.stories');


Auth::routes();

Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::resource('/Category',CategoryController::class);
Route::resource('/Story',StoryController::class);
Route::resource('/Chapter',ChapterController::class);
Route::resource('/User',UserController::class);
Route::resource('/Genre',GenreController::class);

Route::post('theodoi/{id}', [IndexController::class, 'theodoi'])->name('theodoi');
Route::delete('botheodoi/{id}', [IndexController::class, 'botheodoi'])->name('botheodoi');




