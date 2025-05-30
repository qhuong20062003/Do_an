<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;

use UniSharp\LaravelFilemanager\Lfm;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/admin', [AdminController::class, 'loginAdmin']);
Route::post('/admin', [AdminController::class, 'postLoginAdmin']);

// Route::get('/category/{id}', [CategoryController::class, 'showHome'])->name('categories.showHome');
// Route::get('/product/{id}', [AdminProductController::class, 'detailsProduct'])->name('product.details');

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/update/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('categories.delete');
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [AdminMenuController::class, 'index'])->name('menus.index');
        Route::get('/create', [AdminMenuController::class, 'create'])->name('menus.create');
        Route::post('/store', [AdminMenuController::class, 'store'])->name('menus.store');
        Route::get('/edit/{id}', [AdminMenuController::class, 'edit'])->name('menus.edit');
        Route::post('/update/{id}', [AdminMenuController::class, 'update'])->name('menus.update');
        Route::get('/delete/{id}', [AdminMenuController::class, 'delete'])->name('menus.delete');
    });

    //Product
    Route::prefix('product')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('product.index');
        Route::get('/create', [AdminProductController::class, 'create'])->name('product.create');
        Route::post('/store', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::get('/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');
    });

    //SLider
    Route::prefix('slider')->group(function () {
        Route::get('/', [AdminSliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [AdminSliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [AdminSliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}',  [AdminSliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}',  [AdminSliderController::class, 'update'])->name('slider.update');
        Route::get('/delete/{id}',  [AdminSliderController::class, 'delete'])->name('slider.delete');
    });

    //Setting
    Route::prefix('settings')->group(function () {
        Route::get('/', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::get('/create', [AdminSettingController::class, 'create'])->name('settings.create');
        Route::post('/store', [AdminSettingController::class, 'store'])->name('settings.store');
        Route::get('/edit/{id}', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::post('/update/{id}', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::get('/edit/{id}', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::get('/delete/{id}', [AdminSettingController::class, 'delete'])->name('settings.delete');
    });

    //Users
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('users.delete');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/home', fn() => view('customer.home'))->name('customer.home');
    // các route dành riêng cho customer
});

Route::get('/', [ClientHomeController::class, 'index']);
Route::get('/trang-chu', [ClientHomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'showform'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
