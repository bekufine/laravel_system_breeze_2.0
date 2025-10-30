<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })
// ->middleware(['auth', 'role'])
// ->name('adminDashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/order', [OrderController::class, 'page'])->name('order.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::get('/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
});


Route::middleware(['auth', 'role:coordinator'])->prefix('coordinator')->name('coordinator.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard',[CoordinatorController::class, "index"])->name('dashboard');

    Route::get('/orders', [CoordinatorController::class, "orders"])->name("orders");

    Route::get('/history', [CoordinatorController::class, 'history'])->name("history");
});

//нужно создать контроллер для координаторов и засунуть все эти вьюшки туда 

require __DIR__.'/auth.php';
