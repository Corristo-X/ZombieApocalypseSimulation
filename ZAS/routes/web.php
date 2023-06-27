<?php

use App\Http\Controllers\HumanController;
use App\Http\Controllers\ResourceController;
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



Route::get('/',[HumanController::class,'index_avg']);
Route::get('/humans',[HumanController::class,'index']);

Route::post('/reset-database',[HumanController::class,'reset'])->name('resetDatabase');
Route::post('/add-human',[HumanController::class,'addHuman'])->name('addHuman');
Route::post('/delete-human',[HumanController::class,'deleteHuman'])->name('deleteHuman');
Route::post('/add-zombie',[HumanController::class,'addZombie'])->name('addZombie');
Route::post('/delete-zombie',[HumanController::class,'deleteZombie'])->name('deleteZombie');
Route::post('/update-resources',[HumanController::class,'updateResources'])->name('updateResources');

