<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\indexController;

//Admin
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\LoginGGController;
use App\Http\Controllers\FavoriteController;

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

Route::get('/', [indexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [indexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [indexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [indexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [indexController::class, 'movies'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [indexController::class, 'watch'])->name('watch');
Route::get('/dien-vien/{slug}', [indexController::class, 'actor'])->name('actor');
Route::get('/tim-kiem', [indexController::class, 'search_movie'])->name('search');
Route::get('/loc-phim', [indexController::class, 'filter'])->name('filter');
Route::get('/phim-yeu-thich', [indexController::class, 'fav_movie'])->name('favorite');
Route::get('/admin', [HomeController::class, 'index'])->name('home');


Auth::routes();

//admin
Route::middleware('isAdmin')->group(function() {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('category', CategoryController::class);
    Route::post('resorting', [CategoryController::class, 'resorting' ])->name('resorting');
    Route::resource('movie', MovieController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('country', CountryController::class);
    Route::resource('episode', EpisodeController::class);
    Route::resource('info', InfoController::class);
});
    

    // get movie by api
    Route::get('leech_movie', [ApiController::class, 'leech_movie'])->name('leech_movie');
    // get episode by api
    Route::get('leech_episode', [ApiController::class, 'leech_episode'])->name('leech_episode');

    // favorite add
    Route::get('favorites_add', [FavoriteController::class, 'favorites_add'])->name('favorites_add');

    // Choose trending
    Route::get('choose_treding', [ApiController::class, 'choose_treding'])->name('choose_treding');







// login by google
Route::get('auth/google', [LoginGGController::class, 'redirectToGoogle'])->name('login_by_google');
Route::get('auth/google/callback', [LoginGGController::class, 'handleGoogleCallback']);
Route::get('logout-home', [LoginGGController::class, 'logout_home'])->name('logout-home');



