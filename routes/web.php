<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Projects\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [AuthController::class, 'index'])->name('home');

Route::get('/login/form', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');

Route::get('/register/designer/form', [AuthController::class, 'register_designer'])->name('register.designer');
Route::post('/register/designer', [AuthController::class, 'designerRegister'])->name('designer.register');

Route::get('/register/vendor/form', [AuthController::class, 'register_vendor'])->name('register.vendor');
Route::post('/register/vendor', [AuthController::class, 'vendorRegister'])->name('vendor.register');




Route::group(['middleware' => 'auth'], function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile/page', [ProfileController::class, 'editVendor'])->name('vendor.profile');
    Route::put('/profile', [ProfileController::class, 'vendorUpdate'])->name('vendor.update');


    Route::group(['prefix' => 'vendor/product', 'as' => 'product.'], function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/my', [ProductController::class, 'my'])->name('my');

        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('delete');
    });
});



Route::group(['prefix' => 'designer/project', 'as' => 'project.'], function(){
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/create', [ProjectController::class, 'create'])->name('create');
    Route::post('/create', [ProjectController::class, 'store'])->name('store');
    Route::get('/my', [ProjectController::class, 'my'])->name('my');

    Route::get('/{product}/edit', [ProjectController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProjectController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProjectController::class, 'destroy'])->name('delete');
});

    Route::get('/profile/page', [ProfileController::class, 'editdesigner'])->name('designer.profile');
    Route::put('/profile', [ProfileController::class, 'designerUpdate'])->name('designer.update');
    Route::get('/profile/purchase', [ProfileController::class, 'purchase'])->name('profile.purchase');
    Route::get('/buy/{id}', [ProductController::class, 'add_to_cart'])->name('add');

    Route::resource('projects', ProjectController::class);
    Route::delete('/attachments/{id}', [ProjectController::class, 'delete'])->name('attachment.delete');
