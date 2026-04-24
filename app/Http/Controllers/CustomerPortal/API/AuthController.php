<?php

namespace App\Http\Controllers\CustomerPortal\API;

use App\Http\Controllers\CustomerPortal\API\Repository\CustomerAuthRepository;
use App\Http\Controllers\Global\MediaRepository;
use App\Models\Customers;
use App\Models\Media;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;

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
        $userInfo = Customers::where('email', $request->email)->first();
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
            'email' => 'required|unique:customers,email',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'nullable|numeric',
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
                'verified_token' => $activation_token,
                'avatar' => null,
                'password' => bcrypt($request->password),
            ];

            CustomerAuthRepository::register($userData);

            return response()->json([
                'message' => 'Registration has been completed successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        try {
            $credential = ['email' => $request->email, 'password' => $request->password];
            if (Auth::guard('customers')->attempt($credential, $request->remember)) {
                return response()->json([
                    'message' => 'Account has been logged in successfully.',
                    'user' => Auth::guard('customers')->user()
                ], 200);
            } else {
                return response()->json(['errors' => ['error' => 'Invalid Credentials! Please try again']], 401);
            }
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function forgotRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        try {
            $userInfo = Customers::where(['email' => $request->email])->first();
            if ($userInfo == null) {
                throw new Exception('Cannot find user', 404);
            }
            CustomerAuthRepository::forgotRequest($userInfo);
            return response()->json(['message' => 'Please check your inbox to reset your password. If you didn\'n receive your email, please check your junk mail folder']);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }

    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        try {
            $userInfo = Customers::where(['email' => $request->email, 'reset_code' => $request->token])->first();
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
            $userInfo = Customers::select('id', 'email', 'reset_code')->where(['reset_code' => $request->token])->first();
            if ($userInfo == null) {
                return ['status' => 501, 'errors' => 'User not found'];
            }

            return response()->json(['user' => $userInfo ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }

    }
}
