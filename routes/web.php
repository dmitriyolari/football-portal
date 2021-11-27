<?php

use App\Http\Controllers\Accounts\LoginController;
use App\Http\Controllers\Accounts\PasswordRecoveryController;
use App\Http\Controllers\Accounts\RegisterController;
use App\Http\Controllers\Clients\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'showCurrentPost'])->name('post.current');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    require __DIR__ . '/admin/personal_area.php';

    require __DIR__ . '/admin/post_category.php';
    require __DIR__. '/admin/post.php';
    require __DIR__ . '/admin/post_tag.php';

    require __DIR__ . '/admin/users/users_control.php';
});

Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    require __DIR__ . '/user/personal_area.php';
});

Route::group(['prefix' => 'comments', 'middleware' => 'auth'], function () {
    Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comment.item.store');
    Route::delete('/posts/{comment}', [CommentController::class, 'delete'])->name('comment.item.delete');
    Route::post('/posts/{comment}/restore', [CommentController::class, 'restore'])->withTrashed()->name('comment.item.restore');
    Route::post('/posts/{post}/{comment}/answer', [CommentController::class, 'answer'])->name('comment.item.answer');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/password-recovery', [PasswordRecoveryController::class, 'passwordRecoveryForm'])->name('password.recovery');
    Route::post('/password-recovery', [PasswordRecoveryController::class, 'passwordRecoverySendToEmail'])->name('password.recovery.send');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
