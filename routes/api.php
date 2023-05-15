<?php

use App\Http\Controllers\SiswaController;
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

Route::post('/register', [SiswaController::class, 'register']);
Route::post('/login', [SiswaController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/me', [SiswaController::class, 'me']);
    Route::post('/logout', [SiswaController::class, 'logout']);
    Route::post('/getAll', [SiswaController::class, 'getAllUsers']);
    Route::post('/getUser', [SiswaController::class, 'getUser']);
    Route::post('/update', [SiswaController::class, 'updateUser']);
    // Route::post('auth/recover', 'Auth\SiswaController@recover');
    // Route::post('auth/reset', 'Auth\SiswaController@reset');
    // Route::post('auth/change-password', 'Auth\SiswaController@changePassword');
    // Route::post('auth/change-email', 'Auth\SiswaController@changeEmail');
    // Route::post('auth/resend-verification-email', 'Auth\SiswaController@resendVerificationEmail');
    // Route::post('auth/verify-email', 'Auth\SiswaController@verifyEmail');
    // Route::post('auth/resend-verification-code', 'Auth\SiswaController@resendVerificationCode');
});