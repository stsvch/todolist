<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[\App\Http\Controllers\MainController::class, 'home'])->name('home');

Route::get('/about',[\App\Http\Controllers\MainController::class, 'about'])->name('welcome');

Route::get('/review', [\App\Http\Controllers\MainController::class, 'review'])->name('review');

Route::get('/authorization', [\App\Http\Controllers\MainController::class, 'authorization'])->name('authorization');

Route::post('/review', [\App\Http\Controllers\MainController::class, 'review_check'])->name('review_check');



?>
