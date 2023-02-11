<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Roles and Permissions
    Route::resource('/permissions', PermissionController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'attachPermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'detachPermission'])->name('roles.permissions.detach');
    Route::resource('/roles', RoleController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'attachRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'detachRole'])->name('permissions.roles.detach');

    // Users
    Route::resource('/users', UserController::class);
    route::get('/users/{user}/role', [UserController::class, 'role'])->name('users.role');

    Route::post('/users/{user}/roles', [UserController::class, 'attachRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'detachRole'])->name('users.roles.detach');

    Route::post('/users/{user}/permissions', [UserController::class, 'attachPermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'detachPermission'])->name('users.permissions.detach');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
