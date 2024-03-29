<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/userprofile', [DashboardController::class, 'Index']);
// Route::get('/userprofile1', [DashboardController::class, 'Index1']);
// Route::get('/userprofile2', [DashboardController::class, 'Index2']);
// Route::get('/userprofile3', [DashboardController::class, 'Index3']);

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard', 'Index')->name('admindashboard');
       
      });

      Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-product', 'Index')->name('allproduct');
        Route::get('/admin/add-product', 'AddProduct')->name('addproduct');
      });

      Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category', 'Index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
      });

      Route::controller(CustomerController::class)->group(function(){
        Route::get('/admin/customer', 'Index')->name('customer');
      });

      Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/order', 'Index')->name('order');
      });

      Route::controller(FeedbackController::class)->group(function(){
        Route::get('/admin/feedback', 'Index')->name('feedback');
      });
});


require __DIR__.'/auth.php';
