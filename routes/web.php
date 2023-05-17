<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ホームページにGateを追加
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Laravel教科書のテスト用
Route::get('/test',[TestController::class,'test'])->name('test');


// adminの役割のものしか使用できないようにミドルウェア設定
// Route::middleware(['auth','admin'])->group(function(){});
    Route::get('/post/create',[PostController::class,'create']);
    //一覧画面の表示
    Route::get('post',[PostController::class,'index'])->name('post.index');
   


 // 投稿データの保存
 Route::post('post',[PostController::class,'store'])->name('post.store');

//  個別投稿の表示
Route::get('post/show/{post}',[PostController::class,'show'])->name('post.show');

// 編集用
Route::get('post/{post}/edit',[PostController::class,'edit'])->name('post.edit');
Route::patch('post/{post}',[PostController::class,'update'])->name('post.update');

// 削除用
Route::delete('post/{post}',[PostController::class,'destroy'])->name('post.destroy');


require __DIR__.'/auth.php';
