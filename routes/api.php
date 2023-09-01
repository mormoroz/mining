<?php

use App\Http\Api\Companies\Controllers\CompanyController;
use App\Http\Api\Resources\Controllers\ResourceController;
use App\Http\Api\Workers\Controllers\WorkerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{companyId}', [CompanyController::class, 'show']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::put('/companies/{companyId}', [CompanyController::class, 'update']);
Route::patch('/companies/{companyId}', [CompanyController::class, 'change']);
Route::delete('/companies/{companyId}', [CompanyController::class, 'destroy']);

Route::get('/companies/{companyId}/resources', [CompanyController::class, 'getResourcesAttachedToCompany']);
Route::post('/companies/{companyId}/resources', [CompanyController::class, 'attachResourcesToCompany']);
Route::delete('/companies/{companyId}/resources', [CompanyController::class, 'detachResourcesFromCompany']);

Route::get('/resources', [ResourceController::class, 'index']);
Route::get('/resources/{resourceId}', [ResourceController::class, 'show']);
Route::post('/resources', [ResourceController::class, 'store']);
Route::put('/resources/{resourceId}', [ResourceController::class, 'update']);
Route::patch('/resources/{resourceId}', [ResourceController::class, 'change']);
Route::delete('/resources/{resourceId}', [ResourceController::class, 'destroy']);

Route::get('/workers', [WorkerController::class, 'index']);
Route::get('/workers/{workerId}', [WorkerController::class, 'show']);
Route::post('/workers', [WorkerController::class, 'store']);
Route::put('/workers/{workerId}', [WorkerController::class, 'update']);
Route::patch('/workers/{workerId}', [WorkerController::class, 'change']);
Route::delete('/workers/{workerId}', [WorkerController::class, 'destroy']);

Route::get('/companies/{companyId}/workers', [CompanyController::class, 'getWorkersAttachedToCompany']);
