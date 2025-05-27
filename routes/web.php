<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;


use UniSharp\LaravelFilemanager\Lfm;



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/admin', [AdminController::class, 'loginAdmin']);
Route::post('/admin', [AdminController::class, 'postLoginAdmin']);

Route::get('/home', function () {
    return view('home');
});
Route::get('/category/{id}', [CategoryController::class, 'showHome'])->name('categories.showHome');
Route::get('/product/{id}', [AdminProductController::class, 'detailsProduct'])->name('product.details');


Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    });


Route::prefix('menus')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('/update/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menus.delete');

});
//Product
Route::prefix('product')->group(function () {
    Route::get('/', [AdminProductController::class, 'index'])->name('product.index');
    Route::get( '/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post( '/store', [AdminProductController::class, 'store'])->name('product.store');
    Route::get( '/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::post( '/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
    Route::get( '/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');

});
 //SLider
Route::prefix('slider')->group(function () {
    Route::get('/', [SliderAdminController::class, 'index'])->name('slider.index');
    Route::get( '/create', [SliderAdminController::class, 'create'])->name('slider.create');
    Route::post( '/store', [SliderAdminController::class, 'store'])->name('slider.store');
    Route::get( '/edit/{id}',  [SliderAdminController::class, 'edit'])->name('slider.edit');
    Route::post(  '/update/{id}',  [SliderAdminController::class, 'update'])->name('slider.update');
    Route::get(  '/delete/{id}',  [SliderAdminController::class, 'delete'])->name('slider.delete');
});
//Setting
Route::prefix('settings')->group(function () {
    Route::get('/', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::get( '/create', [AdminSettingController::class, 'create'])->name('settings.create');
    Route::post( '/store', [AdminSettingController::class, 'store'])->name('settings.store');
    Route::get( '/edit/{id}', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::post( '/update/{id}', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::get( '/edit/{id}', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::get( '/delete/{id}', [AdminSettingController::class, 'delete'])->name('settings.delete');

});

//Users
Route::prefix('users')->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('users.index');
    Route::get( '/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post( '/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::get( '/edit/{id}', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::post( '/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::get( '/delete/{id}', [AdminUserController::class, 'delete'])->name('users.delete');

});
});




Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/home', fn () => view('customer.home'))->name('customer.home');
    // các route dành riêng cho customer
});

// // Admin routes
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
//     // các route admin khác như quản lý sản phẩm, đơn hàng...
// });
// //guest
// Route::middleware('guest')->group(function () {
//     Route::get('/', function () {
//         return view('welcome'); // Trang giới thiệu, sản phẩm
//     });
// });
// Route::get('/redirect-after-login', function () {
//     $user = auth()->user();

//     if ($user->isAdmin()) {
//         return redirect()->route('admin.dashboard');
//     }

//     if ($user->isCustomer()) {
//         return redirect()->route('customer.profile');
//     }

//     return redirect('/'); // fallback
// })->middleware('auth');
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
  
Route::get('/login', [LoginController::class, 'showform'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', function () {
    return view('pages.home');
})->name('welcome');