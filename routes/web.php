<?php

use App\Http\Controllers\Users\Admin\RoleController;
use App\Http\Livewire\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

/* Route::get('/', function () {
    return view('welcome');
}); */


// Admin routes
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function () {

    Route::prefix('admin')->group(function(){
        // Admin Auth Routes
        Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
        Route::get('/register', [App\Http\Controllers\Auth\AdminRegisterController::class,'showRegisterForm'])->name('admin.register');
        Route::post('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'register'])->name('admin.register.submit');


        Route::resource('roles', RoleController::class);


        // Admins Crud Routes
        Route::get('/', [App\Http\Controllers\Users\Admin\AdminController::class ,'index'])->name('admin.dashboard');
        Route::get('/create', [App\Http\Controllers\Users\Admin\AdminController::class ,'create'])->name('admin.create');
        Route::post('/create', [App\Http\Controllers\Users\Admin\AdminController::class ,'store'])->name('admin.save');

        Route::get('/edit/{admin}', [App\Http\Controllers\Users\Admin\AdminController::class ,'edit'])->name('admin.edit');
        Route::patch('/edit/{admin}', [App\Http\Controllers\Users\Admin\AdminController::class ,'update'])->name('admin.update');

        Route::delete('/delete/{admin}', [App\Http\Controllers\Users\Admin\AdminController::class, 'destroy'])->name('user.delete');


        // Users Crud Routes
        Route::get('/users', [App\Http\Controllers\Users\Admin\UserController::class ,'index'])->name('user.index');
        Route::get('/create-user', [App\Http\Controllers\Users\Admin\UserController::class, 'create'])->name('user.create');
        Route::post('/create-user', [App\Http\Controllers\Users\Admin\UserController::class, 'store'])->name('user.save');

        Route::get('/edit-user/{user}', [App\Http\Controllers\Users\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::patch('/edit-user/{user}', [App\Http\Controllers\Users\Admin\UserController::class, 'update'])->name('user.update');

        Route::delete('/delete-user/{user}', [App\Http\Controllers\Users\Admin\UserController::class, 'destroy'])->name('user.delete');

        // category Crud routes
        Route::get('/category/index', [App\Http\Controllers\Users\Admin\CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [App\Http\Controllers\Users\Admin\CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/index', [App\Http\Controllers\Users\Admin\CategoryController::class, 'store'])->name('category.store');

        Route::get('/category/edit/{Category}', [App\Http\Controllers\Users\Admin\CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/category/edit/{Category}', [App\Http\Controllers\Users\Admin\CategoryController::class, 'update'])->name('category.update');

        Route::delete('/category/delete/{Category}', [App\Http\Controllers\Users\Admin\CategoryController::class, 'destroy'])->name('category.delete');

        // Product Crud routes
        Route::get('/product/index', [App\Http\Controllers\Users\Admin\ProductController::class, 'index'])->name('product.index');

        Route::get('/product/create', [App\Http\Controllers\Users\Admin\ProductController::class, 'create'])->name('product.create');
        Route::post('/product/create', [App\Http\Controllers\Users\Admin\ProductController::class, 'store'])->name('product.store');

        Route::get('/product/edit/{product}', [App\Http\Controllers\Users\Admin\ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/product/edit/{product}', [App\Http\Controllers\Users\Admin\ProductController::class, 'update'])->name('product.update');

        Route::delete('/product/edit/{product}', [App\Http\Controllers\Users\Admin\ProductController::class, 'destroy'])->name('product.destroy');


        // News Crud Routes
        Route::get('/news', function(){
            return view('home-news');
        })->name('news');

        //Pharmacy Crud
        Route::get('/pharmacy', function () {
            return view('pharmacy');
        })->name('pharmacy');

    });

});


// User routes

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function () {
    /* Route::prefix('user')->group(function(){

    }); */
    Route::get('/login', [App\Http\Controllers\Auth\UserLoginController::class,'showLoginForm'])->name('user.login');
    Route::post('/login', [App\Http\Controllers\Auth\UserLoginController::class, 'login'])->name('user.login.submit');
    Route::get('/register', [App\Http\Controllers\Auth\UserRegisterController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [App\Http\Controllers\Auth\UserRegisterController::class ,'register'])->name('user.register.submit');
    Route::get('/', [App\Http\Controllers\Users\User\HomeController::class, 'index'])->name('home');
    Route::get('/showCategory/{category}', [App\Http\Controllers\Users\User\HomeController::class, 'showCategory'])->name('showCategory');
    Route::get('/cart', [App\Http\Controllers\Users\User\HomeController::class, 'cart'])->name('cart');
    Route::get('/add-to-cart/{product}' , [App\Http\Controllers\Users\User\HomeController::class, 'addToCart'])->name('add-to-cart');
    Route::patch('/cart/{product}' , [App\Http\Controllers\Users\User\HomeController::class, 'updateCart'])->name('updateCart');
    Route::delete('/cart/{product}' , [App\Http\Controllers\Users\User\HomeController::class, 'deleteCart'])->name('deleteCart');
    Route::get('/payment-error',[App\Http\Controllers\Users\User\HomeController::class, 'paymentError'])->name('paymentError');

    Route::post('/cart/payment' , [App\Http\Controllers\Users\User\HomeController::class, 'payment'])->name('payment');
    Route::post('/payment-status' , [App\Http\Controllers\Users\User\HomeController::class, 'payStatus'])->name('status');
});



