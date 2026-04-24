<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Global\MediaRepository;
use App\Http\Controllers\Portal\API\Repository\DealsRepository;
use App\Http\Controllers\Portal\API\Repository\TeamRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\Deals;
use App\Models\Media;
use App\Models\Users;
use Carbon\Carbon;
use Exception;
use http\Client\Curl\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DealsController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function listOrSingle(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'limit' => 'nullable|integer',
            'keyword' => 'nullable|string',
            'sort_by' => 'nullable|string',
            'sort_mode' => 'nullable|in:asc,desc',
            'status' => 'nullable|string',
            'type' => 'nullable|string',
            'id' => 'nullable|string',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get Logged-in user information
            $user = Auth::user();

            // Data sanitization
            $filter = [
                'id' => $request->id ?? '',
                'limit' => $request->limit ?? 20,
                'keyword' => $request->keyword ?? '',
                'sort_by' => $request->sort_by ?? 'id',
                'sort_mode' => $request->sort_mode ?? 'desc',
                'status' => $request->status ?? '',
                'type' => $request->type ?? '',
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ];

            // Get list of Single data from Repository
            $rv = DealsRepository::list($filter);

            return response()->json([
                isset($filter['id']) && !empty($filter['id']) ? 'deal' : 'deals' => $rv,
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'type' => 'required|string',
            'description' => 'nullable|string|max:600',
            'gift_card' => 'nullable|integer',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d',
            'promotion_value' => 'nullable|integer',
            'promotion_type' => 'nullable|string',
            'check_limit_per_client' => 'nullable|integer',
            'limit_uses' => 'nullable|integer',
            'set_minimum_amount' => 'nullable|integer',
            'minimum_amount' => 'nullable|integer',
            'enable_point_of_sale' => 'nullable|integer',
            'enable_discount' => 'nullable|integer',
            'discount_code' => 'nullable|string',
            'appointment_time' => 'nullable|integer',
            'appointment_type' => 'nullable|integer',
            'services' => 'required|array',
            'members' => 'nullable|array',
            'products' => 'nullable|array',
            'memberships' => 'nullable|array',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get User information from session
            $user = Auth::user();
            if ($user == null){
                throw new Exception('Cannot find Logged-in user', 404);
            }

            // Set all data
            $dealsData = [
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description ?? '',
                'gift_card' => $request->gift_card ?? 2,
                'start_date' => isset($request->start_date) && !empty($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null,
                'end_date' => isset($request->end_date) && !empty($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : null,
                'company_id' => $user->company_id,
                'user_id' => $user->id,
                'promotion_value' => $request->promotion_value ?? '',
                'promotion_type' => $request->promotion_type ?? '',
                'check_limit_per_client' => $request->check_limit_per_client ?? '',
                'limit_uses' => $request->limit_uses ?? null,
                'set_minimum_amount' => $request->set_minimum_amount ?? 2,
                'minimum_amount' => $request->minimum_amount ?? 100,
                'enable_point_of_sale' => $request->enable_point_of_sale ?? 2,
                'enable_discount' => $request->enable_discount ?? 2,
                'discount_code' => $request->discount_code ?? null,
                'appointment_time' => $request->appointment_time ?? null,
                'appointment_type' => $request->appointment_type ?? 'minutes',
                'services' => $request->services ?? [],
                'products' => $request->products ?? [],
                'memberships' => $request->memberships ?? [],
                'members' => $request->members ?? [],
            ];

            // create data from repository
            $deal = DealsRepository::create($dealsData);

            return response()->json([
                'deal' => $deal
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $input = $request->input();
        $validator = Validator::make($input, [
            'id' => 'required|integer',
            'name' => 'required|string|min:3',
            'type' => 'required|string',
            'description' => 'nullable|string|max:600',
            'gift_card' => 'nullable|integer',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d',
            'promotion_value' => 'nullable|integer',
            'promotion_type' => 'nullable|string',
            'check_limit_per_client' => 'nullable|integer',
            'limit_uses' => 'nullable|integer',
            'set_minimum_amount' => 'nullable|integer',
            'minimum_amount' => 'nullable|integer',
            'enable_point_of_sale' => 'nullable|integer',
            'enable_discount' => 'nullable|integer',
            'discount_code' => 'nullable|string',
            'appointment_time' => 'nullable|string',
            'appointment_type' => 'nullable|string',
            'services' => 'required|array',
            'members' => 'required|array',
            'products' => 'nullable|array',
            'memberships' => 'nullable|array',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get User information from session
            $user = Auth::user();
            if ($user == null){
                throw new Exception('Cannot find Logged-in user', 404);
            }
            $deal = Deals::find($request->id);
            if($deal == null){
                throw new Exception('Cannot find deal', 404);
            }

            // Set all data
            $dealsData = [
                'id' => $request->id,
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description ?? '',
                'gift_card' => $request->gift_card ?? 2,
                'start_date' => isset($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null,
                'end_date' => isset($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : null,
                'company_id' => $user->company_id,
                'user_id' => $user->id,
                'promotion_value' => $request->promotion_value ?? '',
                'promotion_type' => $request->promotion_type ?? '',
                'check_limit_per_client' => $request->check_limit_per_client ?? '',
                'limit_uses' => $request->limit_uses ?? null,
                'set_minimum_amount' => $request->set_minimum_amount ?? 2,
                'minimum_amount' => $request->minimum_amount ?? 100,
                'enable_point_of_sale' => $request->enable_point_of_sale ?? 2,
                'enable_discount' => $request->enable_discount ?? 2,
                'discount_code' => $request->discount_code ?? null,
                'appointment_time' => $request->appointment_time ?? null,
                'appointment_type' => $request->appointment_type ?? 'minutes',
            ];


            $deal = DealsRepository::update($dealsData,$deal);

            return response()->json([
                'deal' => $deal
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Get User information from session
            $user = Auth::user();
            if ($user == null){
                throw new Exception('Cannot find Logged-in user', 404);
            }

            // Get member information
            $deal = Deals::find($request->id);
            if ($deal == null) {
                throw new Exception('Cannot find deal', 404);
            }
            $deal->delete();
            return response()->json([
                'message' => 'Deal has been deleted permanently'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function status(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required|in:1,2,3',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $deal = Deals::find($request->id);
        if ($deal == null) {
            throw new Exception('Cannot find deal', 404);
        }
        $statusData = [
            'id' => $request->id,
            'status' => $request->status,
        ];
        try {
            DealsRepository::status($statusData, $deal);
            return response()->json([
                'message' => 'User status has been updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function duplicate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $deal = Deals::find($request->id);
            if ($deal == null) {
                throw new Exception('Cannot find deal', 404);
            }
            $duplicateDeal = $deal->replicate();
            $duplicateDeal->save();

            return response()->json([
                'message' => 'Deal has been duplicate successfully',
                'deal' => $duplicateDeal
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @param $type
     * @return JsonResponse
     */
    public function removeExtra(Request $request, $type): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'deal_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $deal = Deals::find($request->deal_id);
            if ($deal == null) {
                throw new Exception('Cannot find deal', 404);
            }
            $dealData = [
              'id' => $request->id,
              'type' => $type,
            ];
            $rv = DealsRepository::removeExtra($dealData, $deal);
            return response()->json([
                'message' => $type.' removed successfully',
                'deal' => $rv
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
    /**
     * @param Request $request
     * @param $type
     * @return JsonResponse
     */
    public function addExtra(Request $request, $type): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'deal_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = Auth::user();

            if($user == null){
                throw new Exception('Cannot find user', 422);
            }
            $deal = Deals::find($request->deal_id);
            if ($deal == null) {
                throw new Exception('Cannot find deal', 404);
            }
            $dealData = [
              'id' => $request->id,
              'type' => $type,
              'user_id' => $user->id,
              'company_id' => $user->company_id,
            ];
            $rv = DealsRepository::addExtra($dealData, $deal,);
            return response()->json([
                'message' => $type.' removed successfully',
                'deal' => $rv
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
