<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[UsuarioController::class,'index'])->middleware('auth');
Route::get('/todos',[UsuarioController::class,'todos']);
Route::get('/login',[UsuarioController::class,'loginGet'])->name('login');
Route::post('/login',[UsuarioController::class,'loginPost']);
Route::get('/logout',[UsuarioController::class,'logout']);