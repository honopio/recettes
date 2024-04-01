<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RecettesController;
use App\Http\Controllers\TagController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
//when /recettes, call index() function from RecettesController
Route::get('/recettes', [RecettesController::class, 'index']);
Route::get('/recettes/{recipe}', [RecettesController::class, 'show']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('tags/{tag}', [TagController::class, 'searchByTag']);


Route::get('/tags', [TagController::class, 'index']);
// routes qui appellent les fonctions du controller
// Route::prefix('recettes')->group(function () {
//     Route::get('/', [RecettesController::class, 'index']);
//     Route::post('/', [RecettesController::class, 'store']);
//     Route::get('/{recipe}', [RecettesController::class, 'show']);
//     Route::put('/{recipe}', [RecettesController::class, 'update']);
//     Route::delete('/{recipe}', [RecettesController::class, 'destroy']);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
