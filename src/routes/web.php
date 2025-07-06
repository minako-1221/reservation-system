<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Egulias\EmailValidator\Validation\EmailValidation;
use PgSql\Result;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/thanks', [AuthController::class, 'getThanks'])->name('thanks');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/favorites/{shopId}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::get('/detail/{shop_id}', [ShopController::class, 'show'])->name('shop.show');
Route::post('/detail/{shop_id}', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/done/{shop_id}', [ReservationController::class, 'complete'])->name('reservation.complete');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/manager/{shop}/reservations', [ManagerController::class, 'dashboard'])->name('manager.reservation');

Route::middleware(['auth','verified'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
    Route::get('/reservations/{id}/change', [ReservationController::class, 'change'])->name('reservations.change');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::get('/reservations/{reservation}/changed', function (Reservation $reservation) {
        return view('change_complete', compact('reservation'));
    })->name('reservation.changed');
    Route::get('/reviews/{reservation}/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{reservation}', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/create-manager', [AdminController::class, 'createManager'])->name('admin.createManager');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('manager/shop_edit', [ManagerController::class, 'edit'])->name('manager.edit');
    Route::post('/manager/shop_update', [ManagerController::class, 'update'])->name('manager.update');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '確認メールを再送信しました。');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

