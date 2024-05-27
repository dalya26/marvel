<?php

use App\Http\Controllers\MarvelController;
use App\Http\Controllers\PersonajeController;
use Illuminate\Support\Facades\Route;

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
    return view('app');
});

//Route::get('/', [PersonajeController::class, 'index']);
Route::resource('characters', PersonajeController::class);


//Route::get('characters/{offset?}', [MarvelController::class, 'index'])->middleware(['cache_response'])->name('index')->where('name', '[A-Za-z]+');


Route::get('sync-marvel', [PersonajeController::class, 'geyCharacters'])->name('characters.sync');

Route::get('characters/search', [MarvelController::class, 'search'])->name('characters.search');
Route::get('/characters/{character}', [PersonajeController::class, 'show'])->name('characters.show');
