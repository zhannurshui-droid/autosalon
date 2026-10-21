<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ExportController;

Route::get('/',[PageController::class, 'home'])->name('home');
Route::get('/about',[PageController::class, 'about'])->name('about');
Route::get('/contacts',[PageController::class, 'contacts'])->name('contacts');
Route::get('/rules',[PageController::class, 'rules'])->name('rules');
Route::get('/hello/{name}',[PageController::class, 'hello']);

Route::get('/cars',[CarController::class, 'index'])->name('cars.index');

Route::get('/cars/{car}',[CarController::class,'show'])
  ->whereNumber('car')
  ->name('cars.show');

Route::get('/brands/{brand}', [BrandController::class, 'show'])
   ->whereNumber('brand')
   ->name('brands.show');

Route::redirect('/main','/');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});      

Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-panel'])->group(function () {
    Route::get('/',DashboardController::class)->name('dashboard');
    Route::resource('cars', AdminCarController::class)->except('show');
    Route::resource('brands', AdminBrandController::class)->except('show');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/read', [NotificationController::class, 'readAll'])->name('notifications.read');
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}', [AdminBookingController::class, 'update'])->name('bookings.update');
    Route::post('/exports/catalog', [ExportController::class, 'catalog'])->name('exports.catalog');
Route::get('/exports/{file}', [ExportController::class, 'download'])
    ->where('file', '[A-Za-z0-9._-]+')
    ->name('exports.download');
});

Route::get('/admin/logout',LogoutController::class)->name('admin.logout');

Route::view('/booking','booking')->middleware('hours:9,18')->name('booking');

Route::get('/cars/export', [CarController::class, 'export'])->name('cars.export');

Route::get('/cars/pdf', [CarController::class, 'pdf'])->name('cars.pdf');

Route::get('/cars/{car}/attachment', [CarController::class, 'attachment'])
    ->middleware('auth')
    ->name('cars.attachment');

Route::post('/cars/{car}/bookings', [BookingController::class, 'store'])
    ->middleware('auth')->whereNumber('car')->name('bookings.store');

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')->name('profile');

Route::get('/mail-preview', fn () => new \App\Mail\BookingReceived(\App\Models\Booking::latest()->first()));