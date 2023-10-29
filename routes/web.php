<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
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

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// user 
Route::middleware(['auth','verified'])->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/dashboard', 'user_dashboard')->name('dashboard');
        Route::post('/user/account/update', 'user_account_update')->name('user.account.update');
        Route::get('/user/password/change', 'user_password_change')->name('user.password.change');
        Route::post('/user/password/update', 'user_password_update')->name('user.password.update');
        Route::get('/user/logout', 'user_logout')->name('user.logout');
    });
});
 
// frontend 
Route::controller(FrontendController::class)->group(function(){

    Route::get('/', 'index')->name('frontend.home');

});

// admin with middleware
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'admin_dashboard')->name('admin.dashboard');
        Route::get('/admin/profile', 'admin_profile')->name('admin.profile');
        Route::post('/admin/profile/update', 'admin_profile_update')->name('admin.profile.update');
        Route::get('/admin/change/password', 'admin_change_password')->name('admin.change.password');
        Route::post('/admin/update/password', 'admin_update_password')->name('admin.update.password');
        Route::get('/admin/logout', 'admin_logout')->name('admin.logout');
    });
});

// admin login
Route::controller(AdminController::class)->group(function(){

    Route::get('/admin/login', 'admin_login')->name('admin.login');

});

// brand 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(BrandController::class)->group(function(){
        Route::get('/add/brand', 'create')->name('brand.add');
        Route::post('/store/brand', 'store')->name('brand.store');
        Route::get('/all/brand', 'index')->name('brand.all');
        Route::get('/edit/brand/{id}', 'edit')->name('brand.edit');
        Route::post('/update/brand/{id}', 'update')->name('brand.update');
        Route::get("/brand/delete{id}", 'destroy')->name('brand.delete');
    });
});

// category 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/add/category', 'create')->name('category.add');
        Route::post('/store/category', 'store')->name('category.store');
        Route::get('/all/category', 'index')->name('category.all');
        Route::get('/edit/category/{id}', 'edit')->name('category.edit');
        Route::post('/update/category/{id}', 'update')->name('category.update');
        Route::get("/category/delete{id}", 'destroy')->name('category.delete');
    });
});

// sub category 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(SubCategoryController::class)->group(function(){
       Route::get('/add/subcategory', 'create')->name('subcategory.add');
       Route::post('/store/subcategory', 'store')->name('subcategory.store');
       Route::get('/all/subcategory', 'index')->name('subcategory.all');
    });
});


// vendor with middleware
Route::middleware(['auth', 'role:vendor'])->group(function(){
    Route::controller(VendorController::class)->group(function(){
        Route::get('/vendor/dashboard', 'vendor_dashboard')->name('vendor.dashboard');
        Route::get('/vendor/profile', 'vendor_profile')->name('vendor.profile');
        Route::post('/vendor/profile/update', 'vendor_profile_update')->name('vendor.profile.update');
        Route::get('/vendor/change/password', 'vendor_change_password' )->name('vendor.change.password');
        Route::post('/vendor/update/password', 'vendor_update_password')->name('vendor.update.password');
        Route::get('/vendor/logout', 'vendor_logout')->name('vendor.logout');
    });
});

// vendor login 
Route::controller(VendorController::class)->group(function(){

    Route::get('/vendor/login', 'vendor_login')->name('vendor.login');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
