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

Route::get('/dashboard', [OrderController::class, 'dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::get('/show/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/orders/{order}/download', [CoordinatorController::class, "downloadFile"])->name("download_order");
});


Route::middleware(['auth', 'role:coordinator'])->prefix('coordinator')->name('coordinator.')->group(function () {
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard',[CoordinatorController::class, "index"])->name('dashboard');
    Route::get('/dashboard',[CoordinatorController::class, "dashboard"])->name('dashboard');

    Route::get('/orders', [CoordinatorController::class, "index"])->name('orders');
    Route::post('/orders', [CoordinatorController::class, "store"])->name('store');
    Route::get('/history', [CoordinatorController::class, 'history'])->name('history');
    Route::post('/export', [CoordinatorController::class, "export"])->name('export');
    
    Route::get('/old/orders/{order}', [CoordinatorController::class, "show_old_order"])->name('show_old_order');
     //gotta make url for order and maybe calendar to see orders 
    Route::get('/orders/{order}', [CoordinatorController::class, "show_order"])->name('show_order');

    Route::get('/api/orders', [OrdersController::class, 'index'])->name('orders.api'); //check if it was used somewhere if no  i can use route 
    Route::get('/api/departments/{hotel}', [OrdersController::class, 'departments'])->name('orders.departments');


    // Route::get('/api/users', [UsersController::class, 'index'])->name('users.api');
});


Route::middleware(["auth", "role:area_manager"])->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get("/users/edit", [AreaManagerController::class, 'editUser'])->name('user.edit');
    Route::patch("/users/{user}", [AreaManagerController::class, 'updateUser'])->name('user.update');
    Route::patch("/users/{user}/password", [AreaManagerController::class, 'updateUserPassword'])->name('user.password.update');
    Route::delete("/users/{user}/delete", [AreaManagerController::class, 'destroyUser'])->name('user.destroy');
    
    Route::get("/management", [AreaManagerController::class, "index"])->name('manager.edit');
    Route::post('/add_hotel', [AreaManagerController::class, 'store_hotel'])->name('manager.store.hotel');
    Route::post('/add_department', [AreaManagerController::class, 'store_department'])->name('manager.store.department');  
    Route::post('/add_user', [AreaManagerController::class, 'store_user'])->name('manager.store.user');  
    Route::post('/add_coordinator', [AreaManagerController::class, 'store_coordinator'])->name('manager.store.coordinator');  
});


//нужно создать контроллер для координаторов и засунуть все эти вьюшки туда 

require __DIR__.'/auth.php';
