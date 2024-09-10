<?php

use App\Http\Controllers\BoutiqueInfoController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\TravauxController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(callback: function () {

    //    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
//    Route::get('/page', [PageController::class, 'index'])->name('page.index');
//    Route::get('/addpage', [PageController::class, 'create'])->name('page.create');

    Route::resource('/page', PageController::class,);
    Route::resource('/testimonial', TestimonialsController::class,);
    Route::resource('/media', MediaController::class,);
    Route::post('/media/file', [MediaController::class, 'storeFile']);
    Route::resource('/newsletter', NewsletterController::class,);
    Route::get('/contact', [ContactsController::class, 'index'])->name('contact.index');

//    BLOG : Tag, Post et Categorie
//    Route::get('/blogs/posts', [PostController::class, 'index'])->name('post.index');
//    Route::get('/blogs/categories', [CategoriesController::class, 'index'])->name('categorie.index');
    Route::resource('/blogs/tags', TagsController::class,);
//    Route::get('/blogs/tags', [TagsController::class, 'index'])->name('tags.index');
//    Route::get('/blogs/tags', [TagsController::class, 'edit'])->name('tags.edit');


//    Parametre Platforme
    Route::resource('/BoutiqueInfo', BoutiqueInfoController::class,);
    Route::resource('/Travaux_Panes/Travaux', TravauxController::class,);



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
