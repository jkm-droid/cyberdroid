<?php

use App\Http\Controllers\MpesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('v1/access/token', [MpesaController::class, 'generate_access_token'])->name('access.token');
Route::post('cyberdroid/stk_push', [MpesaController::class, 'mpesa_stk_push'])->name('stk.push');
//call back url goes here
Route::post('cyberdroid/save', [MpesaController::class, 'save_transaction_details'])->name('transaction.save');
Route::post('cyberdroid/validation', [MpesaController::class, 'mpesa_validation'])->name('transaction.validation');
Route::post('cyberdroid/register/urls', [MpesaController::class, 'register_mpesa_urls'])->name('register.urls');
