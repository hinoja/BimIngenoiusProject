<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\{CategoryController, NewsAdminController, UsersController, ProjectController, PlanController};
use App\Http\Controllers\Front\{PagesController, ProjectsController, PlansController, NewsController, QuoteController};

// Front routes
Route::name('front.')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/takekey', 'takekey')->name('takekey');
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

    // Quote
    Route::get('/request-quote', QuoteController::class)->name('quote.form');
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
    //PLANS ROUTES
    Route::prefix('plans')->name('plans.')->group(function () {
        Route::view('/', 'admin.plans.index')->name('index');
        Route::controller(PlanController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::get('/{plan:slug}', 'show')->name('show');
            Route::get('/{plan:slug}/edit', 'edit')->name('edit');
        });
    });
    //     Route::get('/plans/create', [PlanController::class, 'create'])->name('create');
    //     Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('show');
    //     Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('edit');
    // });

    //NEWS ROUTES
    Route::prefix('news')->name('news.')->group(function () {
        Route::view('/', 'admin.news.index')->name('index');
        Route::controller(NewsAdminController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::get('/{news}', 'show')->name('show');
            Route::get('/{news}/edit', 'edit')->name('edit');
            Route::post('/news', 'store')->name('store');
        });
    });

    //CATEGORIES ROUTES
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('categories', 'index')->name('index');
            Route::post('categories', 'store')->name('store');
        });
    });
});
require __DIR__ . '/auth.php';
