<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\PortalAuthRepository;
use App\Http\Controllers\Portal\API\Repository\PortalProfileRepository;
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
            $user_id = Auth::id();
            $user = Users::find($user_id);
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
        Auth::logout();
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
            'about' => 'nullable',
            'mobile' => 'nullable',
            'avatar' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Logged-in user information
            $user_id = Auth::id();

            // Get user information
            $user = Users::find($user_id);
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }

            // Set all data
            $userData = [
                'id' => $user->id,
                'first_name' => $request->first_name ?? $user->first_name,
                'last_name' => $request->last_name ??  $user->last_name,
                'about' => $request->about ??  null,
                'avatar' => $request->avatar ??  null,
                'mobile' => $request->mobile ??  null,
            ];
            $rv = PortalProfileRepository::profile_update($userData, $user);
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
            $user_id = Auth::id();

            // Get user information
            $user = Users::find($user_id);
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
