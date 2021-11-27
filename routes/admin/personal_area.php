<?php

use App\Http\Controllers\Admins\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::put('/name', [AdminController::class, 'editName'])->name('admin.name.update');
Route::put('/email', [AdminController::class, 'editEmail'])->name('admin.email.update');
Route::get('/password', [AdminController::class, 'editPasswordForm'])->name('admin.password.form');
Route::put('/password', [AdminController::class, 'editPassword'])->name('admin.password');
Route::get('/account', [AdminController::class, 'deleteAccountForm'])->name('admin.account.form.delete');
Route::delete('/account', [AdminController::class, 'deleteAccount'])->name('admin.account.delete');
