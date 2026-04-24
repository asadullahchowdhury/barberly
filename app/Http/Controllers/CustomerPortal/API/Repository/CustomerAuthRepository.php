<?php

namespace App\Http\Controllers\CustomerPortal\API\Repository;


use App\Models\Customers;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerAuthRepository
{


    /**
     * @param array $userData
     * @return Customers
     * @throws Exception
     */
    public static function register(array $userData):Customers
    {
        $user = new Customers();
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->mobile = $userData['mobile'];
        $user->avatar =  $userData['avatar'];
        if(!$user->save()){
            throw new Exception('Cannot save user', 422);
        };
        Auth::guard('customers')->login($user);
        return $user;
    }



    /**
     * @throws Exception
     */
    public static function forgotRequest(Customers $userInfo):bool
    {

        $activation_token = md5(uniqid(uniqid(), true));
        $userInfo->reset_code = $activation_token;
        if (!$userInfo->save()){
            throw new Exception('Cannot update user', 422);
        };

        Mail::send('emails.customer-forgot', ['user' => $userInfo], function ($message) use ($userInfo) {
            $message->to($userInfo->email, $userInfo->first_name)->subject(env('APP_NAME') . 'Forgot Request :');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        return true;
    }

}
