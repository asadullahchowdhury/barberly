<?php

namespace App\Http\Controllers\CustomerPortal\API;

use App\Http\Controllers\CustomerPortal\API\Repository\CustomerPortalProfileRepository;
use App\Models\Customers;
use App\Models\Users;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function profile_details(Request $request): JsonResponse
    {
        try {
            $user_id = Auth::guard('customers')->id();
            $user = Customers::find($user_id);
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }
            return response()->json([
                'details' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request):JsonResponse
    {
        Auth::guard('customers')->logout();
        return response()->json([
            'message' => 'Logout successful',
        ],200);
    }
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function profile_update(Request $request): JsonResponse
    {
        $input = $request->input();
        $validator = Validator::make($input, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'nullable',
            'avatar' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'country' => 'nullable',
            'timezone' => 'nullable',
            'currency' => 'nullable',
            'language' => 'nullable',
            'clients_info' => 'nullable',
            'display_booking' => 'nullable',
            'additional_mobile' => 'nullable',
            'source' => 'nullable',
            'address_name' => 'nullable',
            'address' => 'nullable',
            'apartment' => 'nullable',
            'district' => 'nullable',
            'city' => 'nullable',
            'region' => 'nullable',
            'post_code' => 'nullable',
            'email_notification' => 'nullable',
            'email_marketing_notification' => 'nullable',
            'text_message_notification' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Logged-in user information
            $user_id = Auth::guard('customers')->id();

            // Get user information
            $user = Customers::find($user_id);
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }

            // Set all data
            $userData = [
                'id' => $user->id,
                'first_name' => $request->first_name ?? $user->first_name,
                'last_name' => $request->last_name ??  $user->last_name,
                'email' => $request->last_name ??  $user->email,
                'avatar' => $request->avatar,
                'mobile' => $request->mobile,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'country' => $request->country,
                'timezone' => $request->timezone,
                'currency' => $request->currency,
                'language' => $request->language,
                'clients_info' => $request->clients_info,
                'display_booking' => $request->display_booking,
                'additional_mobile' => $request->additional_mobile,
                'source' => $request->source,
                'address_name' => $request->address_name,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'district' => $request->district,
                'city' => $request->city,
                'region' => $request->region,
                'post_code' => $request->post_code,
                'email_notification' => $request->email_notification,
                'email_marketing_notification' => $request->email_marketing_notification,
                'text_message_notification' => $request->text_message_notification,
            ];
            $rv = CustomerPortalProfileRepository::profile_update($userData, $user);
            return response()->json([
                'user' => $rv,
            ],200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function change_password(Request $request):JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required|min:6',
                'password' => 'required|min:6|confirmed',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Logged-in user id
            $user_id = Auth::guard('customers')->id();

            // Get user information
            $user = Customers::find($user_id);
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }

            if(Hash::check($request->current_password, $user->password)){
                $user->password = bcrypt($request->password);
                if(!$user->save()){
                    throw new Exception('Cannot update password', 422);
                };
                return response()->json([
                    'message' => 'Password has been updated successfully',
                ],200);
            } else {
                return response()->json(['errors' => ['current_password' => 'current password does not match']], 422);
            }

        }catch (\Exception $e){
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

}
