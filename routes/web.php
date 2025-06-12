<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminColorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSizeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\LoginController as ClientLoginController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;

use UniSharp\LaravelFilemanager\Lfm;

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/admin', [AdminController::class, 'loginAdmin']);
Route::post('/admin', [AdminController::class, 'postLoginAdmin']);

// Route::get('/category/{id}', [CategoryController::class, 'showHome'])->name('categories.showHome');
// Route::get('/product/{id}', [AdminProductController::class, 'detailsProduct'])->name('product.details');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
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

    //Colors
    Route::prefix('colors')->group(function () {
        Route::get('/', [AdminColorController::class, 'index'])->name('colors.index');
        Route::get('/create', [AdminColorController::class, 'create'])->name('colors.create');
        Route::post('/store', [AdminColorController::class, 'store'])->name('colors.store');
        Route::get('/edit/{id}', [AdminColorController::class, 'edit'])->name('colors.edit');
        Route::post('/update/{id}', [AdminColorController::class, 'update'])->name('colors.update');
        Route::get('/delete/{id}', [AdminColorController::class, 'delete'])->name('colors.delete');
    });

    //Sizes
    Route::prefix('sizes')->group(function () {
        Route::get('/', [AdminSizeController::class, 'index'])->name('sizes.index');
        Route::get('/create', [AdminSizeController::class, 'create'])->name('sizes.create');
        Route::post('/store', [AdminSizeController::class, 'store'])->name('sizes.store');
        Route::get('/edit/{id}', [AdminSizeController::class, 'edit'])->name('sizes.edit');
        Route::post('/update/{id}', [AdminSizeController::class, 'update'])->name('sizes.update');
        Route::get('/delete/{id}', [AdminSizeController::class, 'delete'])->name('sizes.delete');
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

    //Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/edit/{id}', [AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::post('/update', [AdminOrderController::class, 'update'])->name('orders.update');
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

Route::get('/dang-nhap', [ClientLoginController::class, 'showform'])->name('login');
Route::get('/dang-ky', [ClientLoginController::class, 'showformRegister'])->name('register');
Route::post('/gui-dang-nhap', [ClientLoginController::class, 'login'])->name('post.login');
Route::post('/gui-dang-ky', [ClientLoginController::class, 'register'])->name('post.register');

Route::get('/', [ClientHomeController::class, 'index'])->name('index');
Route::get('/trang-chu', [ClientHomeController::class, 'index']);
Route::get('/ho-so', [ProfileController::class, 'myProfile'])->name('my.profile');
Route::get('/chi-tiet-don-hang/{id}', [ProfileController::class, 'detailOrder'])->name('detail.order');
Route::get('/huy-don-hang/{id}', [ProfileController::class, 'cancelOrder'])->name('cancel.order');
Route::post('/cap-nhat-thong-tin-khach-hang', [ProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('/tim-kiem-san-pham', [ClientHomeController::class, 'search'])->name('search.product');
Route::get('/danh-muc/{id}-{slug}', [ProductController::class, 'list'])->name('product.category');
Route::get('/menu/{id}-{slug}', [ProductController::class, 'getProductByMenu'])->name('product.menu');
Route::get('/chi-tiet-san-pham/{id}', [ProductController::class, 'detail'])->name('detail.product');
Route::post('/xem-chi-tiet-san-pham', [ProductController::class, 'viewDetail'])->name('view.detail.product');
Route::post('/kiem-tra-ton-kho', [ProductController::class, 'checkStock'])->name('check.stock');
Route::post('/them-vao-gio-hang', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/cap-nhat', [CartController::class, 'edit'])->name('cart.edit');
Route::post('/gio-hang/xoa', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/gio-hang/xoa/thanh-tieu-de', [CartController::class, 'delete_cart_header'])->name('cart.delete.header');
Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/hinh-thuc/thanh-toan', [CheckoutController::class,'payment'])->name('payment.handle');
Route::get('/thanh-toan/thanh-cong', [CheckoutController::class, 'success'])->name('payment.success');