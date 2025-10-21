<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\AdminController\BrandController;
use App\Http\Controllers\ClientController\CartController;
use App\Http\Controllers\ClientController\HomeController;
use App\Http\Controllers\AdminController\SliderController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\ClientController\BrandViewController;
use App\Http\Controllers\ClientController\ProductViewController;
use App\Http\Controllers\ClientController\CategoryViewController;
// 🏠 Public Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

;

// 🧑‍💼 Admin Dashboard (only for admin)
Route::middleware(['auth', 'verified', IsAdminMiddleware::class])
    ->get('/admin/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('admin.dashboard');

Route::resource('sliders',SliderController::class);
Route::resource('categories',CategoryController::class);
Route::resource('brands',BrandController::class);
Route::resource('products',ProductController::class);

// 
Route::get('/allproducts',[HomeController::class, 'allproducts'])->name('products.all');
Route::get('/allcategories',[HomeController::class, 'allcategories'])->name('categories.all');
Route::get('/allbrads',[HomeController::class, 'allbrads'])->name('brands.all');

// 
Route::get('product/{slug}', [ProductViewController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [CategoryViewController::class, 'show'])->name('categories.show');
Route::get('/brand/{slug}',[BrandViewController::class, 'show'])->name('brands.show');





require __DIR__.'/settings.php';
require __DIR__.'/auth.php'; 

