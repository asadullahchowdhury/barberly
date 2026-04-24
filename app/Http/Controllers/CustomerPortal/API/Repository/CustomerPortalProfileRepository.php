<?php

namespace App\Http\Controllers\CustomerPortal\API\Repository;


use App\Models\Customers;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerPortalProfileRepository
{
    public static function profile_details($request)
    {
        try {
            $user_id = Auth::guard('customers')->id();
            $user = Customers::where('id', $user_id)->first();
            return ['status' => 200, 'data' => $user];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }
    public static function logout($request)
    {
        try {
            Auth::guard('customers')->logout();
            return ['status' => 200, 'msg' => 'Logout Successful'];

        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    /**
     * @throws Exception
     */
    public static function profile_update(array $userData, Customers $user):Customers
    {

        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->avatar = $userData['avatar'];
        $user->mobile = $userData['mobile'];
        $user->gender = $userData['gender'];
        $user->dob = $userData['dob'];
        $user->country = $userData['country'];
        $user->timezone = $userData['timezone'];
        $user->currency = $userData['currency'];
        $user->language = $userData['language'];
        $user->clients_info = $userData['clients_info'];
        $user->display_booking = $userData['display_booking'];
        $user->additional_mobile = $userData['additional_mobile'];
        $user->source = $userData['source'];
        $user->address_name = $userData['address_name'];
        $user->address = $userData['address'];
        $user->apartment = $userData['apartment'];
        $user->district = $userData['district'];
        $user->city = $userData['city'];
        $user->region = $userData['region'];
        $user->post_code = $userData['post_code'];
        $user->email_notification = $userData['email_notification'];
        $user->email_marketing_notification = $userData['email_marketing_notification'];
        $user->text_message_notification = $userData['text_message_notification'];
        if(!$user->save()){
            throw new Exception('Cannot update user', 422);
        };
        return $user;
    }

}
