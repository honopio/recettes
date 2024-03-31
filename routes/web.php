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
    Route::get('/', [HomeController::class, 'index']); //route pour la page d'accueil
use App\Http\Controllers\ContactController;
    Route::get('/contact', [ContactController::class, 'index']); //route pour le formulaire de contact
    Route::post('/contact', [ContactController::class, 'store']); //route pour le formulaire de contact
use App\Http\Controllers\RecettesController;
    Route::get('/recettes', [RecettesController::class, 'index']); //route pour afficher toutes les recettes
    Route::get('/recettes/search', [RecettesController::class, 'search']); //route pour la recherche de recettes
    Route::get('/recettes/{url}',[RecettesController::class, 'show']); //route pour afficher une seule recette
use App\Http\Controllers\CommentController;
    Route::post('/comment', [CommentController::class, 'store']); //route pour le formulaire de commentaire
use App\Http\Controllers\AdminController;
    Route::resource('/admin/recettes', AdminController::class);
use App\Http\Controllers\CaptchaServiceController; //routes pour le captcha
    Route::get('/captcha', [CaptchaServiceController::class, 'index']);
    Route::post('/captcha', [CaptchaServiceController::class, 'captchaFormValidate']);
    Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

    /* Captcha controller - Probleme de route - DELETE ONCE CaptchaServiceController works
use App\Http\Controllers\CaptchaController;
    Route::get('/captcha', [CaptchaController::class, 'showForm']);
    Route::post('/captcha', [CaptchaController::class, 'handleSubmit']);
*/

use App\Http\Controllers\TagController;
    Route::get('/tags', [TagController::class, 'index']);
    Route::get('/tags/{name}', [TagController::class, 'searchByTag']);
