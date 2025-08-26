<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->name('web.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/books', 'bookListing')->name('books.books');
    Route::get('/book-details/{slug}', 'bookDetail')->name('books.book-details');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', AdminBookController::class)->names('books');
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::patch('/books/{book}/toggle', [AdminBookController::class, 'toggleAvailability'])
        ->name('books.toggle');
});

require __DIR__.'/auth.php';
