<?php
use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;

Route::prefix('v2')->middleware(['validateToken'])->group(function () {
    // Authenticated routes
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::get('/user', [AuthController::class, 'getUserAll']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/employees', [EmployeesController::class, 'index'])->middleware('permission:employee.view');
    Route::post('/employees', [EmployeesController::class, 'store'])->middleware('permission:employee.create');
    Route::get('/employees/{employee}', [EmployeesController::class, 'show'])->middleware('permission:employee.view');
    Route::put('/employees/{employee}', [EmployeesController::class, 'update'])->middleware('permission:employee.update');
    Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->middleware('permission:employee.delete');

    Route::get('/category', [CategoryController::class, 'index'])->middleware('permission:category.view');
    Route::post('/category', [CategoryController::class, 'store'])->middleware('permission:category.create');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->middleware('permission:category.view');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->middleware('permission:category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->middleware('permission:category.delete');

    Route::get('/product', [ProductController::class, 'index'])->middleware('permission:product.view');
    Route::post('/product', [ProductController::class, 'store'])->middleware('permission:product.create');
    Route::get('/product/{product}', [ProductController::class, 'show'])->middleware('permission:product.view');
    Route::put('/product/{product}', [ProductController::class, 'update'])->middleware('permission:product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('permission:product.delete');

    Route::get('/customer', [CustomerController::class, 'index'])->middleware('permission:customer.view');
    Route::post('/customer', [CustomerController::class, 'store'])->middleware('permission:customer.create');
    Route::get('/customer/{customer}', [CustomerController::class, 'show'])->middleware('permission:customer.view');
    Route::put('/customer/{customer}', [CustomerController::class, 'update'])->middleware('permission:customer.update');
    Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->middleware('permission:customer.delete');

    Route::get('/role', [RoleController::class, 'index'])->middleware('permission:role.view');
    Route::post('/role', [RoleController::class, 'store'])->middleware('permission:role.create');
    Route::get('/role/{role}', [RoleController::class, 'show'])->middleware('permission:role.view');
    Route::put('/role/{role}', [RoleController::class, 'update'])->middleware('permission:role.update');
    Route::delete('/role/{role}', [RoleController::class, 'destroy'])->middleware('permission:role.delete');

    Route::get('/payments', [PaymentMethodController::class, 'index'])->middleware('permission:payment.view');
    Route::post('/payments', [PaymentMethodController::class, 'store'])->middleware('permission:payment.create');
    Route::get('/payments/{payment}', [PaymentMethodController::class, 'show'])->middleware('permission:payment.view');
    Route::put('/payments/{payment}', [PaymentMethodController::class, 'update'])->middleware('permission:payment.update');
    Route::delete('/payments/{payment}', [PaymentMethodController::class, 'destroy'])->middleware('permission:payment.delete');

    Route::get('/order', [OrderController::class, 'index'])->middleware('permission:order.view');
    Route::post('/order', [OrderController::class, 'store'])->middleware('permission:order.create');
    Route::get('/order/{order}', [OrderController::class, 'show'])->middleware('permission:order.view');
    Route::put('/order/{order}', [OrderController::class, 'update'])->middleware('permission:order.update');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->middleware('permission:order.delete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:dashboard.view');
    Route::post('/dashboard', [DashboardController::class, 'store'])->middleware('permission:dashboard.store');
    Route::get('/dashboard/{dashboard}', [DashboardController::class, 'show'])->middleware('permission:dashboard.view');
    Route::put('/dashboard/{dashboard}', [DashboardController::class, 'update'])->middleware('permission:dashboard.update');
    Route::delete('/dashboard/{dashboard}', [DashboardController::class, 'destroy'])->middleware('permission:dashboard.delete');

    Route::get('/order_detail', [OrderDetailController::class, 'index'])->middleware('permission:order_detail.view');
    Route::post('/order_detail', [OrderDetailController::class, 'store'])->middleware('permission:order_detail.create');
    Route::get('/order_detail/{order_detail}', [OrderDetailController::class, 'show'])->middleware('permission:order_detail.view');
    Route::put('/order_detail/{order_detail}', [OrderDetailController::class, 'update'])->middleware('permission:order_detail.update');
    Route::delete('/order_detail/{order_detail}', [OrderDetailController::class, 'destroy'])->middleware('permission:order_detail.delete');

    Route::get('/permission', [PermissionController::class, 'index'])->middleware('permission:permission.view');
    Route::post('/permission', [PermissionController::class, 'store'])->middleware('permission:permission.create');
    Route::get('/permission/{permission}', [PermissionController::class, 'show'])->middleware('permission:permission.view');
    Route::put('/permission/{permission}', [PermissionController::class, 'update'])->middleware('permission:permission.update');
    Route::delete('/permission/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:permission.delete');

    Route::post('/role/{roleId}/sync-permissions', [RoleController::class, 'syncPermissions']);
    Route::post('/users/{userId}/sync-roles', [AuthController::class, 'syncRoles']);


});

// public routes
Route::prefix('v2')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});
