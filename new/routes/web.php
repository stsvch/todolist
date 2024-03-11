<?php

use App\Http\Controllers\MainController;
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

Route::get('/',[MainController::class, 'home'])->name('home');

Route::post('/',[MainController::class, 'signin'])->name('signin');

Route::get('/review', [MainController::class, 'review'])->name('review');

Route::get('/authorization', [MainController::class, 'authorization'])->name('authorization');

Route::post('/authorization', [MainController::class, 'authorization_add'])->name('authorization_add');

Route::post('/review', [MainController::class, 'review_check'])->name('review_check');

Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

Route::get('/profile', [MainController::class, 'profile'])->name('profile');
Route::get('/home', [MainController::class, 'logout'])->name('logout');

Route::post('profile/{listid}', [MainController::class, 'delete']);

?>
