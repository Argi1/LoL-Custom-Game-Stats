<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DataController;

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

Route::get('/', [DataController::class, 'showIndex']);
Route::post('/search', [DataController::class, 'search']);
Route::get('/autocomplete-search', [DataController::class, 'autocompleteSearch']);

Route::get('/summoner/{name}', [DataController::class, 'showSummoner']);
Route::get('/summoner', [DataController::class, 'showAllSummoners']);

Route::get('/champion/{name}', [DataController::class, 'showChampion']);
Route::get('/champion', [DataController::class, 'showAllChampions']);

Route::get('/matches', [DataController::class, 'showMatchHistory']);
Route::get('/matches/{id}', [DataController::class, 'showMatch']);

Route::get('/admin/update-champions', [AdminController::class, 'showChampionUpdate']);
Route::post('/admin/update-champions', [AdminController::class, 'updateChampionList']);

Route::get('/admin/game', [AdminController::class, 'showGame']);
Route::post('/admin/game', [AdminController::class, 'addGame']);

Route::get('/signin', [CustomAuthController::class, 'index'])->name('signin');
Route::post('/signin', [CustomAuthController::class, 'authenticate']); 
Route::get('/signout', [CustomAuthController::class, 'signOut']);