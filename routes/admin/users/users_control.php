<?php

use App\Http\Controllers\Admins\UserController;

Route::get('/users/list', [UserController::class, 'index'])->name('admin.users.index');
Route::put('/users/{user}/admin', [UserController::class, 'makeAdmin'])->name('admin.users.make.admin');
Route::delete('/users/{user}', [UserController::class, 'delete'])->name('admin.users.delete');
Route::put('/users/{user}/restore', [UserController::class, 'restoreUser'])->withTrashed()->name('admin.users.restore');
