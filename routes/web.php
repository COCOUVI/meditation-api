<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MeditationController;
use App\Http\Controllers\Admin\AffirmationController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RetreatPlanController;
use App\Http\Controllers\Admin\FoodComfortFormController;
use App\Http\Controllers\Admin\DailyQuoteController;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});

// Route de redirection pour le middleware auth par défaut
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Routes admin - Authentification
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Routes protégées par authentification admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // CRUD Méditations
        Route::resource('meditations', MeditationController::class);
        
        // CRUD Affirmations
        Route::resource('affirmations', AffirmationController::class);
        
        // CRUD Événements
        Route::resource('events', EventController::class);
        
        // CRUD Blogs
        Route::resource('blogs', BlogController::class);
        
        // CRUD Utilisateurs
        Route::resource('users', UserController::class);
        
        // CRUD Plans de retraite
        Route::resource('retreat-plans', RetreatPlanController::class);
        
        // Formulaires de confort alimentaire
        Route::get('food-comfort-forms', [FoodComfortFormController::class, 'index'])->name('food-comfort-forms.index');
        Route::get('food-comfort-forms/{id}', [FoodComfortFormController::class, 'show'])->name('food-comfort-forms.show');
        Route::delete('food-comfort-forms/{id}', [FoodComfortFormController::class, 'destroy'])->name('food-comfort-forms.destroy');
        
        // Phrases du jour
        Route::get('daily-quotes', [DailyQuoteController::class, 'index'])->name('daily-quotes.index');
        Route::get('daily-quotes/create', [DailyQuoteController::class, 'create'])->name('daily-quotes.create');
        Route::post('daily-quotes', [DailyQuoteController::class, 'store'])->name('daily-quotes.store');
        Route::get('daily-quotes/{id}/edit', [DailyQuoteController::class, 'edit'])->name('daily-quotes.edit');
        Route::put('daily-quotes/{id}', [DailyQuoteController::class, 'update'])->name('daily-quotes.update');
        Route::delete('daily-quotes/{id}', [DailyQuoteController::class, 'destroy'])->name('daily-quotes.destroy');
        
        // CMS - Gestion des paramètres de l'application
        Route::prefix('cms')->name('cms.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('index');
            Route::post('/settings/{key}', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('update');
            Route::post('/settings/bulk', [\App\Http\Controllers\Admin\SettingsController::class, 'bulkUpdate'])->name('bulk-update');
            Route::delete('/settings/{key}/file', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteFile'])->name('delete-file');
            Route::post('/settings/{key}/reset', [\App\Http\Controllers\Admin\SettingsController::class, 'reset'])->name('reset');
        });
    });
});
