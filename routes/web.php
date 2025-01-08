<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\PasswordController;


Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

//user page
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/laporan/tambah', [LaporanController::class, 'create'])->name('user.tambahLaporan');
    Route::post('/laporan/simpan', [LaporanController::class, 'store'])->name('user.storeLaporan');
    Route::get('/laporan/{id}', [UserController::class, 'viewReport'])->name('user.lihatLaporan');
    Route::get('/history-laporan', [UserController::class, 'reportHistory'])->name('user.historyLaporan');
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settingUser');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});


//admin page
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/reportList', [AdminController::class, 'reportList'])->name('admin.historyLaporan');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settingAdmin');
    Route::get('/admin/processReport/{id}', [AdminController::class, 'processReport'])->name('admin.processReport');
    Route::patch('/admin/updateReport/{id}', [LaporanController::class, 'update'])->name('admin.updateReport');
    Route::get('/admin/manageUser', [AdminController::class, 'manageUser'])->name('admin.manageUser');
    Route::get('/admin/addUser', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('/admin/storeUser', [AdminController::class, 'storeUser'])->name('admin.storeUser');
    Route::get('/admin/manageAdmin', [AdminController::class, 'manageAdmin'])->name('admin.manageAdmin');
    Route::get('/admin/addAdmin', [AdminController::class, 'addAdmin'])->name('admin.addAdmin');
    Route::post('/admin/storeAdmin', [AdminController::class, 'storeAdmin'])->name('admin.storeAdmin');
    Route::patch('/admin/blacklistUser/{id}', [AdminController::class, 'blacklistUser'])->name('admin.blacklistUser');
    Route::patch('/admin/nonactiveUser/{id}', [AdminController::class, 'nonactiveUser'])->name('admin.nonactiveUser');
    Route::patch('/admin/activeUser/{id}', [AdminController::class, 'activeUser'])->name('admin.activeUser');
    Route::get('/admin/editUser/{id}', [AdminController::class, 'editDataUser'])->name('admin.editDataUser');
    Route::patch('/admin/updateUser/{id}', [ProfileController::class, 'updateDataUser'])->name('admin.updateDataUser');
    Route::put('/setUserPassword/{id}', [PasswordController::class, 'updateByAdmin'])->name('admin.updateUserPassword');
});
require __DIR__.'/auth.php';
