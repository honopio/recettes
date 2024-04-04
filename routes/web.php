<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RecettesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [HomeController::class, 'index']);

/* RECETTES */
//inertia route doesn't work either ???
// Route::get('/recettes', function () {
//     return Inertia::render('Recettes');
// });

Route::get('/recettes', [RecettesController::class, 'index'])->name('recettes');
Route::get('/recettes/search', [RecettesController::class, 'search']);
Route::get('/recettes/{recipe}', [RecettesController::class, 'show'])->name('recettes.show');
Route::post('/recettes/{recipe}', [CommentController::class, 'store'])->name('comments.store');

/* TAGS */
Route::get('/tags', [TagController::class, 'index']);
Route::get('tags/{tag}', [TagController::class, 'searchByTag']);

/* ADMIN */
Route::get('/admin/recettes/edit/{id}', [AdminController::class, 'edit'])->name('recettes.edit');
Route::get('/admin/recettes/create', [AdminController::class, 'create']);
Route::post('/admin/recettes/create', [AdminController::class, 'store'])->name('recettes.store');
Route::get('/admin/recettes', [AdminController::class, 'index'])->name('admin.recettes.index');
Route::post('/admin/recettes/edit/{id}', [AdminController::class, 'update']);
Route::delete('/admin/recettes/{id}', [AdminController::class, 'destroy'])->name('recettes.destroy');


/* CONTACT */
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/* COMMENT */
Route::post('/comment', [CommentController::class, 'store']); //route pour le formulaire de commentaire

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
