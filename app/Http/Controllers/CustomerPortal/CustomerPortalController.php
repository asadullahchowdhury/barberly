<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Models\Customers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CustomerPortalController extends BaseController
{
    public function index(){
        return view('customer-portal.app');
    }


    public function change_password(Request $request, $token)
    {
        $user = Customers::where('reset_code', $token)->first();
        if ($user == null) {
            abort(404);
        }
//        return redirect(route('customer.change.password',   ['token' => $token]));
        return redirect(route('lvs.customer.any', 'change/password/' . $token));
    }
}
