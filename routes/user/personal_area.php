<?php

use App\Http\Controllers\Clients\UserController;

Route::get('/', [UserController::class, 'personalArea'])->name('user.area');
Route::put('/name', [UserController::class, 'editName'])->name('user.name.update');
Route::put('/email', [UserController::class, 'editEmail'])->name('user.email.update');
Route::put('/subscription/return', [UserController::class, 'returnSubscription'])->name('user.subscription.return');
Route::put('/subscription/cancel', [UserController::class, 'cancelSubscription'])->name('user.subscription.cancel');
Route::get('/password', [UserController::class, 'editPasswordForm'])->name('user.password.form');
Route::put('/password', [UserController::class, 'editPassword'])->name('user.password');
Route::get('/account', [UserController::class, 'deleteAccountForm'])->name('user.account.form.delete');
Route::delete('/account', [UserController::class, 'deleteAccount'])->name('user.account.delete');
