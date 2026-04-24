<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PortalProfileRepository
{
    public static function profile_details($request)
    {
        try {
            $user_id = Auth::id();
            $user = Users::where('id', $user_id)->first();
            return ['status' => 200, 'data' => $user];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }
    public static function logout($request)
    {
        try {
            Auth::logout();
            return ['status' => 200, 'msg' => 'Logout Successful'];

        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    /**
     * @throws Exception
     */
    public static function profile_update(array $userData, Users $user):Users
    {

        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->about = $userData['about'];
        $user->avatar = $userData['avatar'];
        $user->mobile = $userData['mobile'];
        if(!$user->save()){
            throw new Exception('Cannot update user', 422);
        };
        return $user;
    }

}
