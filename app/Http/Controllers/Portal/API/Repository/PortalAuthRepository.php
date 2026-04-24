<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PortalAuthRepository
{


    /**
     * @param array $userData
     * @return Users
     * @throws Exception
     */
    public static function register(array $userData):Users
    {
        $user = new Users();
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->mobile = $userData['mobile'];
        $user->country = $userData['country'];
        $user->timezone = $userData['timezone'];
        $user->currency = $userData['currency'];
        $user->language = $userData['language'];
        $user->verified_token = $userData['verified_token'];
        $user->avatar =  $userData['avatar'];

        $code = rand(100000, 999999);
        $user->otp = $code + $user->id;
        Mail::send('emails.verify-account', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->first_name)->subject(env('APP_NAME') . 'Verify your account :');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        if(!$user->save()){
            throw new Exception('Cannot save user', 422);
        };
        return $user;
    }


    /**
     * @throws Exception
     */
    public static function loginFacebook(array $userData):Users
    {

        $user = new Users();
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->password =  $userData['password'];
        $user->provider_id = $userData['provider_id'];
        $user->provider = $userData['provider'];
        $user->mobile = $userData['mobile'];
        $user->country = $userData['country'];
        $user->timezone = $userData['timezone'];
        $user->currency = $userData['currency'];
        $user->language = $userData['language'];
        $user->avatar = $userData['avatar'];
        if(!$user->save()){
            throw new Exception('Cannot save user', 422);
        };

        return $user;
    }


    /**
     * @throws Exception
     */
    public static function forgotRequest(Users $userInfo):bool
    {

        $activation_token = md5(uniqid(uniqid(), true));
        $userInfo->reset_code = $activation_token;
        if (!$userInfo->save()){
            throw new Exception('Cannot update user', 422);
        };

        Mail::send('emails.forgot-request', ['user' => $userInfo], function ($message) use ($userInfo) {
            $message->to($userInfo->email, $userInfo->first_name)->subject(env('APP_NAME') . 'Forgot Request :');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        return true;
    }

}
