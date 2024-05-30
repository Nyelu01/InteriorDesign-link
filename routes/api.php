<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Projects\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Registration
Route::controller(AuthController::class)->group(function(){
    Route::post('designer/register', 'designerRegister');
    Route::post('vendor/register', 'vendorRegister');
    Route::post('login', 'userLogin');
});

//Authentication
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    //User must Be authenticated
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout/{userId}', [AuthController::class, 'logout']);
    });
});


//protected routes
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
});


Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::put('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/delete/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
