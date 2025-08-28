<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ContactRequestController;
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

Route::get('/brands', [BrandController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/certificates', [CertificateController::class, 'index']);

// форма заявки
Route::post('/contact-requests', [ContactRequestController::class, 'store'])
    ->middleware('throttle:contact');

// алиас под уже существующий фронт (ContactModal отправляет на /api/leads)
Route::post('/leads', [ContactRequestController::class, 'store'])
    ->middleware('throttle:contact');
