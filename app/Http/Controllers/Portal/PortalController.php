<?php

namespace App\Http\Controllers\Portal;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class PortalController extends BaseController
{
    public function index()
    {
        return view('portal.app');
    }

    public function auth()
    {
        return view('auth-portal.app');
    }

    public function verifyAccount(Request $request, $verified_token)
    {
        $user = Users::where('verified_token', $verified_token)->first();
        if ($user == null) {
            abort(404);
        }
        $user->email_verified_at = Carbon::now();
        $user->verified_token = null;
        $user->save();
        return redirect(route('lvs.auth', ['any' => 'sign-in']));
    }

    public function change_password(Request $request, $token)
    {
        $user = Users::where('reset_code', $token)->first();
        if ($user == null) {
            abort(404);
        }
        return redirect(route('lvs.auth', 'change/password/' . $token,));
    }

    public function inviteTeam()
    {
        return view('emails.invite-team');
    }

    public function customerInvite()
    {
        return view('emails.customer-invite');
    }

}
