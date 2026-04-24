<?php

use App\Http\Controllers\Portal\PortalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerPortal\CustomerPortalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
 * The root route ('/') will be for customer panel
 * we will remove the route bellow after creating customer panel
 * For now leave it as it is.
 * */



/*
 *
 * Routes for Customer portal
 * For Customer Portal the root url will be ('/')
 *
 * */
Route::get('/', function () {
    return redirect()->route('lvs.customer.home');
});

Route::group(
    ['prefix' => 'customer/'],
    function () {
        Route::get('', [CustomerPortalController::class, 'index'])->where('any','.*')->name('lvs.customer.home');                                           // route for customer dashboard
        Route::get('{any}', [CustomerPortalController::class, 'index'])->where('any','.*')->name('lvs.customer.any');                                           // route for customer dashboard
        Route::get('auth/{any}', [CustomerPortalController::class, 'index'])->where('any','.*')->name('lvs.auth.customer.any');
        Route::get('auth/change/password/{token}', [CustomerPortalController::class, 'change_password'])->name('customer.change.password');
    }
);


/*
 *
 * Routes for portal
 * For Portal the root url will be ('/portal')
 *
 * */

Route::group(
    ['prefix' => 'portal/auth'],
    function () {
        Route::middleware('PortalCheck')->get('/account/{any}', [PortalController::class, 'auth'])->where('any', '.*')->name('lvs.account.setup');                             // Route for portal pages

        // Route for Portal authentication
        Route::middleware('PortalLoginCheck')->get('/{any}', [PortalController::class, 'auth'])->where('any', '.*')->name('lvs.auth');                             // Route for portal pages
        Route::get('/verify/account/{token}', [PortalController::class, 'verifyAccount'])->name('verify.account');
        Route::get('/change/password/{token}', [PortalController::class, 'change_password'])->name('change.password');


    }
);


Route::group(
    ['prefix' => 'portal'],
    function () {
        Route::middleware('PortalCheck')->get('/', [PortalController::class, 'index'])->where('any', '.*')->name('lvs.portal.home');                       // Route for  portal Dashboard
        Route::middleware('PortalCheck')->get('/{any}', [PortalController::class, 'index'])->where('any', '.*')->name('lvs.portal.home.any');
    }
);

Route::get('/invite/team', [PortalController::class, 'inviteTeam'])->name('invite.team');


Route::get('/customer-invitation', [PortalController::class, 'customerInvite'])->name('email.customer.invite');
