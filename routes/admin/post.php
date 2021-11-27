<?php

use App\Http\Controllers\Admins\PostAdminController;

Route::get('/posts', [PostAdminController::class, 'index'])->name("admin.posts.index");
Route::post('/posts', [PostAdminController::class, 'store'])->name("admin.posts.item.store");
Route::get('/posts/create', [PostAdminController::class, 'create'])->name("admin.posts.item.create");
Route::get('/posts/{post}/edit', [PostAdminController::class, 'edit'])->name("admin.posts.item");
Route::post('/post/{post}', [PostAdminController::class, 'update'])->name("admin.posts.item.update");
Route::delete('/post/{post}', [PostAdminController::class, 'delete'])->name("admin.posts.item.delete");
Route::post('/posts/{post}/restore', [PostAdminController::class, 'restore'])->withTrashed()->name("admin.posts.item.restore");
