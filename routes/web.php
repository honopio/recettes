<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
use App\Http\Controllers\HomeController;
    Route::get('/', [HomeController::class, 'index']);
use App\Http\Controllers\ContactController;
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']); //ajout de la route pour le formulaire de contact
use App\Http\Controllers\RecettesController;
    Route::get('/recettes', [RecettesController::class, 'index']);
    Route::get('/recettes/{url}',[RecettesController::class, 'show']);
use App\Http\Controllers\CommentController;
    Route::post('/comment', [CommentController::class, 'store']);
use App\Http\Controllers\AdminController;
    Route::resource('/admin/recettes', AdminController::class);

