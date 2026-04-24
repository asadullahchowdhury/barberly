<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Global\MediaRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAuthRepository;
use App\Models\Media;
use App\Models\Users;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkAccount(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $userInfo = Users::where('email', $request->email)->first();
        if ($userInfo == null) {
            return response()->json([
                'message' => 'Account does not exist',
                'provider' => 'register'
            ], 200);
        }
        return response()->json([
            'message' => 'Account exist',
            'provider' => $userInfo->provider
        ], 200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'nullable|numeric',
            'country' => 'nullable|string',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|string',
            'language' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $activation_token = md5(uniqid(uniqid(), true));

            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'timezone' => $request->timezone,
                'currency' => $request->currency,
                'language' => $request->language,
                'verified_token' => $activation_token,
                'avatar' => null,
                'password' => bcrypt($request->password),
            ];

            PortalAuthRepository::register($userData);

            return response()->json([
                'message' => 'Registration has been completed successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function resendCode(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'The email does not exist.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = Users::where('email', $request->email)->first();

            if ($user == null) {
                throw new Exception('Cannot find user', 422);
            };

            $code = rand(100000, 999999);
            $user->otp = $code + $user->id;
            Mail::send('emails.verify-account', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email, $user->first_name)->subject(env('APP_NAME') . 'Verify your account :');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            if (!$user->save()) {
                throw new Exception('Cannot save user', 422);
            };

            return response()->json([
                'message' => 'Code has been sent successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        try {
            $credential = ['email' => $request->email, 'password' => $request->password];
            $user = Users::where('email', $request->email)->first();
            if($user->otp != null){
                $code = rand(100000, 999999);
                $user->otp = $code + $user->id;
                Mail::send('emails.verify-account', ['user' => $user], function ($message) use ($user) {
                    $message->to($user->email, $user->first_name)->subject(env('APP_NAME') . 'Verify your account :');
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });
                if(!$user->save()){
                    throw new Exception('Cannot save user', 422);
                };

                return response()->json(['errors' => ['otp' => 'please verify your account']], 401);
            }
            if (Auth::attempt($credential, $request->remember)) {
                return response()->json([
                    'message' => 'Account has been logged in successfully.',
                    'user' => Auth::user()
                ], 200);
            } else {
                return response()->json(['errors' => ['error' => 'Invalid Credentials! Please try again']], 401);
            }
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function loginFacebook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'provider_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        try {
            $user = Users::where('provider_id', $request->provider_id)->first();
            if ($user != null) {
                Auth::login($user);
                return response()->json([
                    'message' => 'Account has been logged in successfully.',
                    'user' => $user
                ], 200);
            } else {
                $random_password = Str::random(12);

                $userData = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => strtolower($request->provider_id . '@facebook.com'),
                    'password' => bcrypt($random_password),
                    'provider_id' => $request->provider_id,
                    'provider' => Users::FACEBOOK,
                    'mobile' => $request->mobile,
                    'country' => $request->country,
                    'timezone' => $request->timezone,
                    'currency' => $request->currency,
                    'language' => $request->language,
                    'avatar' => null,
                ];
                $rv = PortalAuthRepository::loginFacebook($userData);
                return response()->json([
                    'message' => 'Account has been created successfully.',
                    'user' => $rv
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        try {
            $userInfo = Users::where(['email' => $request->email, 'otp' => $request->otp])->first();
            if ($userInfo == null) {
                return response()->json(['errors' => ['code' => ['Invalid request. Kindly check your otp please.']]], 401);
            }
            $userInfo->otp = null;
            if (!$userInfo->save()) {
                throw new Exception('Cannot update user', 422);
            };
            Auth::login($userInfo);
            return response()->json(['message' => 'Account has been verified successfully']);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function forgotRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        try {
            $userInfo = Users::where(['email' => $request->email])->first();
            if ($userInfo == null) {
                throw new Exception('Cannot find user', 404);
            }
            PortalAuthRepository::forgotRequest($userInfo);
            return response()->json(['message' => 'Please check your inbox to reset your password. If you didn\'n receive your email, please check your junk mail folder']);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }

    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        try {
            $userInfo = Users::where(['email' => $request->email, 'reset_code' => $request->token])->first();
            if ($userInfo == null) {
                throw new Exception('Cannot find user', 404);
            }
            $userInfo->password = bcrypt($request->password);
            $userInfo->reset_code = null;
            if (!$userInfo->save()) {
                throw new Exception('Cannot update user', 422);
            };
            return response()->json(['message' => 'Password has been updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    public function getAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        try {
            $userInfo = Users::select('id', 'email', 'reset_code')->where(['reset_code' => $request->token])->first();
            if ($userInfo == null) {
                return ['status' => 501, 'errors' => 'User not found'];
            }

            return response()->json(['message' => 'Password has been updated successfully', 'user' => $userInfo]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }

    }
}
