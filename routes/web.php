<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\{PagesController, ProjectsController, PlansController, NewsController};

// Front routes
Route::name('front.')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/quote', 'quote')->name('quote');
    });

    // Projects routes
    Route::controller(ProjectsController::class)->prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{project}', 'show')->name('show');
    });

    // News routes
    Route::controller(NewsController::class)->prefix('news')->name('news.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{news}', 'show')->name('show');
    });

    // Plans routes
    Route::controller(PlansController::class)->prefix('plans')->name('plans.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{plan}', 'show')->name('show');
    });
});

Route::get('lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//---------------------ADMIN ROUTES---------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');

    Route::prefix('users')->name('users.')->controller(UsersController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::patch('status/{user}', 'updateStatus')->name('status');
    });
    //MESSAGES ROUTES
    Route::view('contacts', 'admin.contacts.index')->name('contacts.index');

    //PROJECTS ROUTES
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::view('/', 'admin.projects.index')->name('index');
        Route::view('/create', 'admin.projects.create')->name('create');
        Route::controller(ProjectController::class)->group(function () {
            Route::get('/{project:slug}', 'show')->name('show');
            Route::get('/{project:slug}/edit', 'edit')->name('edit');
        });
    });

    //CATEGORIES ROUTES
    Route::view('categories', 'admin.categories.index')->name('categories.index');
});
require __DIR__ . '/auth.php';
