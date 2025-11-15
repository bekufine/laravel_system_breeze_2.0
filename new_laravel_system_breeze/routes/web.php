<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\AreaManagerController;

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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/order', [OrderController::class, 'page'])->name('order.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::get('/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
});


Route::middleware(['auth', 'role:coordinator'])->prefix('coordinator')->name('coordinator.')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard',[CoordinatorController::class, "index"])->name('dashboard');
    Route::view('/dashboard',"coordinator.dashboard")->name('dashboard');

    Route::get('/orders', [CoordinatorController::class, "index"])->name('orders');
    Route::post('/orders', [CoordinatorController::class, "store"])->name('store');
    Route::get('/history', [CoordinatorController::class, 'history'])->name('history');
    Route::post('/export', [CoordinatorController::class, "export"])->name('export');

    Route::get('/api/orders', [OrdersController::class, 'index'])->name('orders.api');
    Route::get('/api/departments/{hotel}', [OrdersController::class, 'departments'])->name('orders.departments');
    // Route::get('/api/users', [UsersController::class, 'index'])->name('users.api');
});


Route::middleware(["auth", "role:area_manager"])->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get("/management", [AreaManagerController::class, "index"])->name('manager.edit');
    Route::post('/add_hotel', [AreaManagerController::class, 'store_hotel'])->name('manager.store.hotel');
    Route::post('/add_department', [AreaManagerController::class, 'store_department'])->name('manager.store.department');  
    Route::post('/add_user', [AreaManagerController::class, 'store_user'])->name('manager.store.user');  
    Route::post('/add_coordinator', [AreaManagerController::class, 'store_coordinator'])->name('manager.store.coordinator');  
});


//нужно создать контроллер для координаторов и засунуть все эти вьюшки туда 

require __DIR__.'/auth.php';
