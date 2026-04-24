<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\Portal\API\AuthController;
use App\Http\Controllers\Portal\API\BookingController;
use App\Http\Controllers\Portal\API\CompaniesController;
use App\Http\Controllers\Portal\API\CategoriesController;
use App\Http\Controllers\Portal\API\CustomersController;
use App\Http\Controllers\Portal\API\DashboardController;
use App\Http\Controllers\Portal\API\DealsController;
use App\Http\Controllers\Portal\API\MarketPlaceProfileController;
use App\Http\Controllers\Portal\API\MembershipsController;
use App\Http\Controllers\Portal\API\ProfileController;
use App\Http\Controllers\Portal\API\ResourcesController;
use App\Http\Controllers\Portal\API\ServicesController;
use App\Http\Controllers\Portal\API\TeamController;
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
    ['middleware' => ['PortalAuth'], 'prefix' => 'auth'],
    function () {
        Route::get('/check/account', [AuthController::class, 'checkAccount'])->name('Portal.Auth.Check.Account');
        Route::post('/login', [AuthController::class, 'login'])->name('Portal.Auth.Login');
        Route::post('/login/facebook', [AuthController::class, 'loginFacebook'])->name('Portal.Auth.Login.Facebook');
        Route::post('/register', [AuthController::class, 'register'])->name('Portal.Auth.Register');
        Route::post('/resend/code', [AuthController::class, 'resendCode'])->name('Portal.Auth.Resend.Code');
        Route::patch('/forgot/request', [AuthController::class, 'forgotRequest'])->name('Portal.Auth.Forgot.Request');
        Route::patch('/reset/password', [AuthController::class, 'resetPassword'])->name('Portal.Auth.Reset.Password');
        Route::patch('/verify/account', [AuthController::class, 'verifyCode'])->name('Portal.Auth.Account.Verify');
        Route::get('/get/account', [AuthController::class, 'getAccount'])->name('Portal.Auth.Account.Get');
    }
);

//Profile
Route::group(
    ['middleware' => ['PortalAuthReq']],
    function () {
        Route::group(
            ['prefix' => 'profile'],
            function () {

                Route::get('/me', [ProfileController::class, 'profile_details'])->name('Portal.Profile.Details');

                Route::patch('/update', [ProfileController::class, 'profile_update'])->name('Portal.Profile.Update');

                Route::patch('/change/password', [ProfileController::class, 'change_password'])->name('Portal.Change.Password');

                Route::get('/logout', [ProfileController::class, 'logout'])->name('Portal.Profile.Logout'); // Logout

            });
        Route::group(
            ['prefix' => 'portal'],
            function () {

                // Dashboard
                Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('Dashboard');

                // Services
                Route::get('/services', [ServicesController::class, 'serviceList'])->name('Service.List');

                // Account Setup
                Route::post('/setup/account', [CompaniesController::class, 'SetupAccount'])->name('Portal.Setup.Account');


                // Media Upload
                Route::prefix('media')->group(function () {
                    Route::post('/upload', [MediaController::class, 'Upload'])->name('MEDIA.UPLOAD');
                });

                Route::group(
                    ['prefix' => 'customers'],
                    function () {
                        Route::get('', [CustomersController::class, 'listOrSingle'])->name('Portal.Customers.List');

                        Route::post('', [CustomersController::class, 'create'])->name('Portal.Customers.Create');

                        Route::patch('/update', [CustomersController::class, 'update'])->name('Portal.Customers.Update');

                        Route::delete('', [CustomersController::class, 'delete'])->name('Portal.Customers.Delete');
                    }
                );

                // Categories
                Route::group(
                    ['prefix' => 'categories'],
                    function () {
                        Route::get('', [CategoriesController::class, 'listOrSingle'])->name('Portal.Categories.List.Single');

                        Route::patch('/sort', [CategoriesController::class, 'sort'])->name('Portal.Categories.Sort');
                        Route::post('', [CategoriesController::class, 'create'])->name('Portal.Categories.Create');
                        Route::patch('/update', [CategoriesController::class, 'update'])->name('Portal.Categories.Update');
                        Route::delete('', [CategoriesController::class, 'delete'])->name('Portal.Categories.Delete');

                        // Cataloger Services
                        Route::group(
                            ['prefix' => 'services'],
                            function () {

                                Route::get('', [ServicesController::class, 'listOrSingle'])->name('Portal.Services.List.Single');


                                Route::post('', [ServicesController::class, 'create'])->name('Portal.Services.Create');


                                Route::patch('/update', [ServicesController::class, 'update'])->name('Portal.Services.Update');


                                Route::delete('', [ServicesController::class, 'delete'])->name('Portal.Services.Delete');


                                Route::patch('/sort', [ServicesController::class, 'sort'])->name('Portal.Services.Sort');


                                Route::delete('/{service_id}/member/{member_id}/remove', [ServicesController::class, 'removeMember'])->name('Portal.Services.Member.Remove');
                                Route::post('/{service_id}/member/{member_id}/add', [ServicesController::class, 'addMember'])->name('Portal.Services.Member.Add');
                            }
                        );
                        // Memberships
                        Route::group(
                            ['prefix' => 'memberships'],
                            function () {

                                Route::get('', [MembershipsController::class, 'listOrSingle'])->name('Portal.Membership.List.Single');


                                Route::post('', [MembershipsController::class, 'create'])->name('Portal.Membership.Create');


                                Route::patch('/update', [MembershipsController::class, 'update'])->name('Portal.Membership.Update');


                                Route::delete('', [MembershipsController::class, 'delete'])->name('Portal.Membership.Delete');
                            }
                        );
                    }
                );

                // Team members
                Route::group(
                    ['prefix' => 'team'],
                    function () {
                        // Use get method to get list and get single data
                        // If params has id then it will return single data else list of data
                        Route::get('', [TeamController::class, 'listOrSingle'])->name('Portal.Team.List.Single');


                        Route::post('', [TeamController::class, 'create'])->name('Portal.Team.Create');


                        Route::patch('/update', [TeamController::class, 'update'])->name('Portal.Team.Update');


                        Route::delete('', [TeamController::class, 'delete'])->name('Portal.Team.Delete');
                    }
                );

                // Booking
                Route::group(
                    ['prefix' => 'booking'],
                    function () {
                        // Use get method to get list and get single data
                        // If params has id then it will return single data else list of data
                        Route::get('', [BookingController::class, 'list'])->name('Portal.Booking.Single');
                        Route::get('/single', [BookingController::class, 'Single'])->name('Portal.Booking.Single');

                        Route::post('', [BookingController::class, 'create'])->name('Portal.Booking.Create');
                        Route::patch('/status', [BookingController::class, 'status'])->name('Portal.Booking.Status');

                        Route::delete('/cancel', [BookingController::class, 'cancel'])->name('Portal.Booking.Cancel');

                        Route::patch('/remove/customer', [BookingController::class, 'removeCustomer'])->name('Portal.Booking.Remove.Customer');
                        Route::patch('/add/customer', [BookingController::class, 'addCustomer'])->name('Portal.Booking.Add.Customer');

                        Route::delete('/remove/service', [BookingController::class, 'removeService'])->name('Portal.Booking.Remove.Services');
                        Route::post('/add/service', [BookingController::class, 'addService'])->name('Portal.Booking.Add.Services');
                    }
                );

                // Marketplace profile
                Route::group(
                    ['prefix' => 'market-place'],
                    function () {
                        // Use get method to get list and get single data
                        // If params has id then it will return single data else list of data
                        Route::get('', [MarketPlaceProfileController::class, 'Single'])->name('Portal.Marketplace.Single');

                        Route::post('', [MarketPlaceProfileController::class, 'create'])->name('Portal.Marketplace.Create');
                        Route::patch('', [MarketPlaceProfileController::class, 'update'])->name('Portal.Marketplace.Update');
                        Route::post('photo', [MarketPlaceProfileController::class, 'photoCreate'])->name('Portal.Marketplace.Photo.Create');
                        Route::get('photo', [MarketPlaceProfileController::class, 'photosGet'])->name('Portal.Marketplace.Photos.Get');
                        Route::delete('photo', [MarketPlaceProfileController::class, 'photoDelete'])->name('Portal.Marketplace.Photo.Delete');
                    }
                );

                // Companies
                Route::group(
                    ['prefix' => 'company'],
                    function () {
                        Route::get('', [CompaniesController::class, 'Single'])->name('Portal.Company.Single');

                    }
                );


                // Resources
                Route::group(
                    ['prefix' => 'resources'],
                    function () {
                        // Use get method to get list and get single data
                        // If params has id then it will return single data else list of data
                        Route::get('', [ResourcesController::class, 'listOrSingle'])->name('Portal.Resources.List.Single');


                        Route::post('', [ResourcesController::class, 'create'])->name('Portal.Resources.Create');


                        Route::patch('/update', [ResourcesController::class, 'update'])->name('Portal.Resources.Update');


                        Route::delete('', [ResourcesController::class, 'delete'])->name('Portal.Resources.Delete');
                    }
                );

                // Deals
                Route::group(
                    ['prefix' => 'deals'],
                    function () {
                        // Use get method to get list and get single data
                        // If params has id then it will return single data else list of data
                        Route::get('', [DealsController::class, 'listOrSingle'])->name('Portal.Deals.List.Single');


                        Route::post('', [DealsController::class, 'create'])->name('Portal.Deals.Create');


                        Route::patch('', [DealsController::class, 'update'])->name('Portal.Deals.Update');

                        // use patch method to change status
                        Route::patch('change/status', [DealsController::class, 'status'])->name('Portal.Deals.Status');


                        Route::delete('', [DealsController::class, 'delete'])->name('Portal.Deals.Delete');

                        // use post method to duplicate existing data
                        Route::post('/duplicate', [DealsController::class, 'duplicate'])->name('Portal.Deals.Duplicate');


                        Route::delete('/add/{type}/{id}', [DealsController::class, 'addExtra'])->name('Portal.Deals.Remove');
                        Route::delete('/remove/{type}/{id}', [DealsController::class, 'removeExtra'])->name('Portal.Deals.Remove');
                    }
                );
            }
        );
    }
);



