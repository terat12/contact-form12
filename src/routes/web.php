<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;


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

// お問い合わせ
Route::get('/',         [ContactController::class, 'create'])->name('contact.create');   // 入力
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm'); // 確認
Route::post('/',        [ContactController::class, 'store'])->name('contact.store');     // 保存→thanks
Route::get('/thanks',   [ContactController::class, 'thanks'])->name('contact.thanks');   // 完了

// 管理画面（一覧＋検索）
Route::get('/admin',    [AdminController::class, 'index'])->name('admin.index');
// 削除（UIは次ステップで付けます）
Route::delete('/admin/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');

// 登録
Route::get('/register',  [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ログイン
Route::get('/login',  [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


