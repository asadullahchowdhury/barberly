<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\CategoriesRepository;
use App\Http\Controllers\Portal\API\Repository\DashboardRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\Categories;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     *@throws Exception
     */
    public function dashboard(Request $request): JsonResponse
    {

        try {
            // Get Logged-in user information
            $user = Auth::user();

            if($user == null){
                throw new Exception('Cannot find user', 422);
            }

            $filter = [
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ];
            $rv = DashboardRepository::dashboard($filter);

            return response()->json([
                'data' => $rv
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }


}
