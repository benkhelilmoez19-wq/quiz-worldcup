<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes - FIFA World Cup 2026 Edition
|--------------------------------------------------------------------------
*/

/**
 * --- ACCÈS PUBLIC ---
 */
Route::get('/', function () {
    return view('index');
})->name('home');

/**
 * LA CORRECTION : 
 * J'ai nommé la route 'stades' pour correspondre à l'appel dans vos fichiers Blade
 * (layouts/app.blade.php à la ligne 71).
 */
Route::get('/stades', [QuizController::class, 'stades'])->name('stades');


/**
 * --- AUTHENTIFICATION ---
 */
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/**
 * --- ESPACES PROTÉGÉS (Middleware Auth) ---
 */
Route::middleware(['auth'])->group(function () {
    
    // Dashboard principal du joueur
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * --- LOGIQUE DU QUIZ & CLASSEMENT ---
     */
    
    // 1. Liste des catégories
    Route::get('/categories', [QuizController::class, 'index'])->name('quiz.categories');
    
    // 2. LE CLASSEMENT
    Route::get('/leaderboard', [QuizController::class, 'leaderboard'])->name('quiz.leaderboard');
    
    // 3. Mode "Tout Jouer" (Mode Expert)
    Route::get('/quiz/all-challenges', [QuizController::class, 'playAll'])->name('quiz.playAll');
    
    // 4. Quiz spécifique par catégorie
    Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
    Route::get('/quiz/{id}/play', [QuizController::class, 'show'])->name('quiz.play');
    
    // 5. Soumission des résultats
    Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');

    // Alias pour compatibilité
    Route::get('/categories-list', [QuizController::class, 'index'])->name('quiz.index');


    /**
     * --- ESPACE ADMINISTRATION ---
     */
    Route::prefix('admin')->group(function () {
        
        // 1. Vue d'ensemble (Statistiques)
        Route::get('/stats', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // 2. GESTION DES UTILISATEURS
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminController::class, 'usersIndex'])->name('users.index');
            Route::get('/create', [AdminController::class, 'userCreate'])->name('users.create');
            Route::post('/store', [AdminController::class, 'userStore'])->name('users.store');
            Route::get('/{id}', [AdminController::class, 'userShow'])->name('users.show');
            Route::get('/{id}/edit', [AdminController::class, 'userEdit'])->name('users.edit');
            Route::put('/{id}/update', [AdminController::class, 'userUpdate'])->name('users.update');
            Route::delete('/{id}', [AdminController::class, 'userDelete'])->name('users.delete');
        });
        
        // 3. Gestion des Catégories
        Route::get('/categories/manage', [AdminController::class, 'categoriesIndex'])->name('categories.index');
        Route::post('/categories/store', [AdminController::class, 'categoryStore'])->name('categories.store');
        Route::delete('/categories/{id}', [AdminController::class, 'categoryDelete'])->name('categories.delete');
        
        // 4. Banque de Questions
        Route::prefix('questions')->group(function () {
            Route::get('/manage', [AdminController::class, 'questionsIndex'])->name('questions.index');
            Route::post('/store', [AdminController::class, 'questionStore'])->name('questions.store');
            Route::put('/{id}/update', [AdminController::class, 'questionUpdate'])->name('questions.update');
            Route::delete('/{id}', [AdminController::class, 'questionDelete'])->name('questions.delete');
        });
    });
});