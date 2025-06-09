<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\{CategoryController, NewsAdminController, UsersController, ProjectController, PlanController, TagController, QuoteController};
use App\Http\Controllers\Front\{CategoriesController, PagesController, ProjectsController, PlansController, NewsController, QuoteController as FrontQuoteController};

// Front routes
Route::name('front.')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/turnkey-offer', 'turnkey')->name('turnkey');
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

    // Categories/Domains routes
    Route::controller(CategoriesController::class)->prefix('our-domains')->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{category}', 'show')->name('show');
    });

    // Quote
    Route::get('/request-quote', [FrontQuoteController::class, 'showForm'])->name('quote.form');
    Route::post('/request-quote', [FrontQuoteController::class, 'submitForm'])->name('quote.submit');
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

    // Routes pour les tags
    Route::prefix('tags')->name('tags.')->controller(TagController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{tag}', 'destroy')->name('destroy');
    });

    // Routes pour les devis (quotes)
    Route::prefix('quotes')->name('quotes.')->group(function () {
        Route::view('/', 'admin.quotes.index')->name('index');
        Route::view('/create', 'admin.quotes.create')->name('create');
        Route::controller(QuoteController::class)->group(function () {
            Route::get('/{quote}', 'show')->name('show');
            Route::get('/{quote}/edit', 'edit')->name('edit');
            Route::get('/categories', 'categories')->name('categories');
            Route::post('/categories', 'storeCategory')->name('categories.store');
            Route::delete('/categories/{category}', 'destroyCategory')->name('categories.destroy');
        });
    });
});

// Routes pour la gestion des devis (admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/quotes', function() {
        return view('admin.quotes.index');
    })->name('quotes.index');

    Route::get('/quotes/{quote}', function(App\Models\Quote $quote) {
        return view('admin.quotes.show', compact('quote'));
    })->name('quotes.show');

    Route::get('/quotes/{quote}/edit', function(App\Models\Quote $quote) {
        return view('admin.quotes.edit', compact('quote'));
    })->name('quotes.edit');
});

require __DIR__ . '/auth.php';






