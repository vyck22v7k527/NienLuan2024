<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCategoryPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminLogoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProfileController;
use App\Models\category;
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

Route::get('admin/login',  [AdminController::class, 'index'])->name('admin.login.index');
Route::post('admin/login', [AdminController::class, 'post'])->name('admin.login.post');
Route::get('admin/logout', [AdminLogoutController::class, 'logout'])->name('admin.logout');
Route::middleware(['auth'])->group(function () {

    Route::middleware(['checkAdmin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home.index');
            Route::prefix('category')->group(function () {
                Route::get('/',             [AdminCategoryController::class, 'index'])->name('categories.index');
                Route::post('/',            [AdminCategoryController::class, 'post'])->name('categories.post');
                Route::get('/delete/{id}',  [AdminCategoryController::class, 'delete'])->name('categories.delete');
            });

            Route::prefix('product')->group(function () {
                Route::get('/',             [AdminProductController::class, 'index'])->name('admin.products.index');
                Route::get('/create',       [AdminProductController::class, 'create'])->name('admin.products.create');
                Route::post('/create',      [AdminProductController::class, 'post'])->name('admin.products.post');
                Route::get('/edit/{id}',    [AdminProductController::class, 'edit'])->name('admin.products.edit');
                Route::post('/edit',        [AdminProductController::class, 'update'])->name('admin.products.update');
                Route::get('/delete/{id}', [AdminProductController::class, 'delete'])->name('admin.products.delete');
            });

            Route::prefix('category-post')->group(function () {
                Route::get('/',             [AdminCategoryPostController::class, 'index'])->name('admin.category_posts.index');
                Route::post('/',            [AdminCategoryPostController::class, 'post'])->name('admin.category_posts.post');
                Route::get('/delete/{id}',  [AdminCategoryPostController::class, 'delete'])->name('admin.category_posts.delete');
            });

            Route::prefix('post')->group(function () {
                Route::get('/',             [AdminPostController::class, 'index'])->name('admin.posts.index');
                Route::get('/create',       [AdminPostController::class, 'create'])->name('admin.posts.create');
                Route::post('/create',      [AdminPostController::class, 'post'])->name('admin.posts.post');
                Route::get('/edit/{id}',    [AdminPostController::class, 'edit'])->name('admin.posts.edit');
                Route::post('/edit',        [AdminPostController::class, 'update'])->name('admin.posts.update');
                Route::get('/delete/{id}',  [AdminPostController::class, 'delete'])->name('admin.posts.delete');
            });

            Route::prefix('order')->group(function () {
                Route::get('/',                                 [AdminOrderController::class, 'index'])->name('admin.orders.index');
                Route::get('/order-detail/{id}',                [AdminOrderController::class, 'indexOrderDetail'])->name('admin.orders.indexOrderDetail');
                Route::get('/cancel/{id}',                      [AdminOrderController::class, 'cancel'])->name('admin.orders.cancel');
                Route::get('/update-order-determination/{id}',  [AdminOrderController::class, 'orderDetermination'])->name('admin.orders.orderDetermination');
            });

            Route::prefix('user')->group(function () {
                Route::get('/',                                 [AdminUserController::class, 'index'])->name('admin.users.index');
            });
        });
    });
});



Route::get('/',  [HomeController::class, 'index'])->name('userhome.index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [LoginController::class, 'indexRegister'])->name('register.index');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/products',  [HomeController::class, 'products'])->name('home.products.index');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail.index');
Route::get('/search', [HomeController::class, 'search'])->name('search.index');
Route::get('/productCategory/{id}',  [HomeController::class, 'productCategory'])->name('productCategory.index');

Route::get('/contact', [NewsController::class, 'index'])->name('contact.index');
Route::post('/contact', [NewsController::class, 'submitForm'])->name('contact.submit');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.profile');

Route::post('/create-order', [CartController::class, 'createOrder'])->name('cart.order');
Route::get('/cancel-order', [CartController::class, 'cancelOrder'])->name('order.cancel');
