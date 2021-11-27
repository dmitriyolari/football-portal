<?php

use App\Http\Controllers\Admins\TagController;

Route::get('post_tags', [TagController::class, 'index'])->name("admin.tags.index");
Route::post('post_tags', [TagController::class, 'store'])->name("admin.tags.item.store");
Route::get('post_tags/create', [TagController::class, 'create'])->name("admin.tags.item.create");
Route::get('post_tags/{tag}/edit', [TagController::class, 'edit'])->name("admin.tags.item");
Route::post('post_tags/{tag}', [TagController::class, 'update'])->name("admin.tags.item.update");
Route::delete('post_tags/{tag}', [TagController::class, 'delete'])->name("admin.tags.item.delete");
