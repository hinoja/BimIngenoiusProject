<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\UsersController;

Route::controller(PagesController::class)->name('front.')->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/projects', 'projects')->name('projects');
    Route::get('/plans', 'plans')->name('plans');
    Route::get('/quote', 'quote')->name('quote');
    Route::get('/news', 'news')->name('news');
    Route::get('/contact', 'contact')->name('contact');
});

Route::get('lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//---------------------ADMIN ROUTES---------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('users')->name('users.')->controller(UsersController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::patch('status/{user}', 'updateStatus')->name('status');
    });
});
require __DIR__ . '/auth.php';
