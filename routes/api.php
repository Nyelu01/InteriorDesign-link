<?php

use App\Http\Controllers\Auth\ClientController;
use App\Http\Controllers\Budget\BudgetController;
use App\Http\Controllers\DesignRequiremeent\DesignRequirementController;
use App\Http\Controllers\Projects\ProjectController;
use App\Models\Budget;
use App\Models\DesignRequirement;
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
Route::post('register', [ClientController::class, 'register']);

//Authentication
 Route::post('login', [ClientController::class, 'login']);

//User must Be authenticated
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout/{userId}', [ClientController::class, 'logout']);
});


//protected routes
Route::middleware('auth:sanctum')->group( function () {

    Route::resource('projects', ProjectController::class);
    Route::resource('requirements', DesignRequirementController::class);
    Route::resource('budgets', BudgetController::class);
});
