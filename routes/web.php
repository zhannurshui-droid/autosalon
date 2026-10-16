<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;

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

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function() {
    Route::get('/',DashboardController::class)->name('dashboard');
    Route::resource('cars', AdminCarController::class)->except('show');
    Route::resource('brands', AdminBrandController::class)->except('show');
});

Route::get('/admin/logout',LogoutController::class)->name('admin.logout');

Route::view('/booking','booking')->middleware('hours:9,18')->name('booking');