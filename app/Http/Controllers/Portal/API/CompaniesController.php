<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\Companies;
use App\Models\Users;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends BaseController
{

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function setupAccount(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->input(), [
            'business_name' => 'required|min:3',
            'services' => 'required',
            'team_size' => 'required',
            'is_physical' => 'required', //1. false, 2. true
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Logged-in user information
            $user = Users::find(Auth::id());
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }
            // set all data
            $companyData = [
                'user_id' => $user->id,
                'business_name' => $request->business_name,
                'website' => $request->website ?? null,
                'services' => $request->services,
                'address' => $request->address ?? null,
                'apartment' => $request->apartment ?? null,
                'district' => $request->district ?? null,
                'city' => $request->city ?? null,
                'region' => $request->region ?? null,
                'postcode' => $request->postcode ?? null,
                'country' => $request->country ?? null,
                'team_size' => $request->team_size ?? null,
                'is_physical' => $request->is_physical ?? null,
            ];

            // create data from repository
            $rv =  PortalAccountRepository::setupAccount($companyData, $user);
            return response()->json([
                'message' => 'Account setup completed',
                'data' => $rv
            ]);
        } catch (\Exception $e) {
           return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function Single(Request $request): JsonResponse
    {

        try {
            // Get Logged-in user information
            $user = Auth::user();
            if($user == null){
                throw new Exception('Cannot find Logged-in user', 404);
            }
            if($user->company_id == null){
                throw new Exception('User must be assigned to a company', 500);
            }

            // Get  Single data
            $rv = Companies::find($user->company_id);
            if($rv == null){
                throw new Exception('Cannot find company', 404);
            }

            return response()->json([
                'company' => $rv,
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

}
