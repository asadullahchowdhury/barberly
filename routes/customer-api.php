<?php

use App\Http\Controllers\CustomerPortal\API\AuthController;
use App\Http\Controllers\CustomerPortal\API\ProfileController;
use App\Http\Controllers\CustomerPortal\MarketPlaceController;
use App\Http\Controllers\MediaController;
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
// Authentication
Route::group(
    ['middleware' => ['CustomerAuth'], 'prefix' => 'auth'],
    function () {
        Route::get('/check/account', [AuthController::class, 'checkAccount'])->name('Customer.Portal.Auth.Check.Account');
        Route::post('/login', [AuthController::class, 'login'])->name('Customer.Portal.Auth.Login');
        Route::post('/register', [AuthController::class, 'register'])->name('Customer.Portal.Auth.Register');
        Route::patch('/forgot/request', [AuthController::class, 'forgotRequest'])->name('Customer.Portal.Auth.Forgot.Request');
        Route::patch('/reset/password', [AuthController::class, 'resetPassword'])->name('Customer.Portal.Auth.Reset.Password');
        Route::get('/get/account', [AuthController::class, 'getAccount'])->name('Customer.Portal.Auth.Get.Account');
    }
);

//Profile
Route::group(
    ['middleware' => ['CustomerAuthReq']],
    function () {
        // Profile
        Route::prefix('profile')->group(function () {
            // use get method to get data
            Route::get('/me', [ProfileController::class, 'profile_details'])->name('Customer.Portal.Profile.Details');
            // use get method to logout
            Route::get('/logout', [ProfileController::class, 'logout'])->name('Customer.Portal.Profile.Details');
            // use patch method to update data
            Route::patch('/update', [ProfileController::class, 'profile_update'])->name('Customer.Portal.Profile.Update');
            // use patch method to update data
            Route::patch('/change/password', [ProfileController::class, 'change_password'])->name('Customer.Portal.Change.Password');
        });

        // Media Upload
        Route::prefix('media')->group(function () {
            Route::post('/upload', [MediaController::class, 'Upload'])->name('MEDIA.UPLOAD');
        });
    }


);

Route::apiResource('marketplace', MarketPlaceController::class);
