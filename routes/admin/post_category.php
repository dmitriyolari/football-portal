<?php

use App\Http\Controllers\Admins\CategoryController;

Route::get('/post_categories', [CategoryController::class, 'index'])->name("admin.categories.index");
Route::post('/post_categories', [CategoryController::class, 'store'])->name("admin.categories.item.store");
Route::get('/post_categories/create', [CategoryController::class, 'create'])->name("admin.categories.item.create");
Route::get('/post_categories/{category}/edit', [CategoryController::class, 'edit'])->name("admin.categories.item");
Route::post('/post_categories/{category}', [CategoryController::class, 'update'])->name("admin.categories.item.update");
Route::delete('/post_categories/{category}', [CategoryController::class, 'delete'])->name("admin.categories.item.delete");
