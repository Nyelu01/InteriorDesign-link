<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BudgetItem\BudgetItemController;
use App\Http\Controllers\Designer\DesignerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\BudgetItem;

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

});

    // vendorr routes
    Route::middleware(['auth','user-role:vendor'])->group(function () {
        Route::get('/profile/page', [ProfileController::class, 'editVendor'])->name('vendor.profile');
        Route::put('/profile', [ProfileController::class, 'vendorUpdate'])->name('vendor.update');
        Route::resource('vendor/product', ProductController::class);
});

//designer routes

        Route::get('designer/profile', [ProfileController::class, 'designerProfile'])->name('designer.profile');
        Route::put('designer/update', [ProfileController::class, 'designerUpdate'])->name('designer.update');
        Route::resource('designer/projects', DesignerController::class);
        Route::resource('designer/items', BudgetItemController::class);
        Route::get('designer/materials', [DesignerController::class, 'viewMaterials'])->name('design.materials');
        Route::get('designer/requirements', [DesignerController::class, 'client_requirements'])->name('design.requirements');
        Route::get('/generate-pdf', [DesignerController::class, 'generateBudget'])->name('generate.pdf');
        Route::get('/designer/budget-list', [DesignerController::class, 'budgetList'])->name('designer.budgetList');
        Route::delete('/designer/budget/{id}', [DesignerController::class, 'deleteBudget'])->name('designer.budget.delete');







