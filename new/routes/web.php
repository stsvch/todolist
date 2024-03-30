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

Route::get('/authorization',[MainController::class, 'authorization'])->name('authorization');

Route::get('/profile', [MainController::class, 'profile'])->name('profile');

Route::post('/profile_add', [MainController::class, 'profile_add'])->name('profile_add');

Route::post('/sign_in',[MainController::class, 'sign_in'])->name('sign_in');

Route::get('/logout', [MainController::class, 'logout'])->name('logout');

Route::get('/logout_admin', [MainController::class, 'logout_admin'])->name('logout_admin');

Route::post('/add_task', [MainController::class, 'add_task'])->name('add_task');

Route::get('/task', [MainController::class, 'task'])->name('task');

Route::get('/clndr', [MainController::class, 'clndr'])->name('clndr');




Route::get('/calendar/{date}', [MainController::class, 'show_date_task'])->name('calendar');

Route::get('/tasks', [MainController::class, 'show_all'])->name('tasks');

Route::get('/users', [MainController::class, 'show_user_admin'])->name('users');

Route::post('task/{listid}', [MainController::class, 'delete_task']);

Route::post('user/{listid}', [MainController::class, 'delete_user']);

Route::get('/users_task', [MainController::class, 'show_task_admin'])->name('users_task');

Route::get('/page1', [MainController::class, 'page1'])->name('page1');
Route::get('/page2', [MainController::class, 'page2'])->name('page2');
Route::get('/page3', [MainController::class, 'page3'])->name('page3');
Route::get('/page4', [MainController::class, 'page4'])->name('page4');
Route::get('/page5', [MainController::class, 'page5'])->name('page5');
?>
