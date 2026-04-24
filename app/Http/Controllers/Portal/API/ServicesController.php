<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\ServicesRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\CatelougeServices;
use App\Models\ServiceMembers;
use App\Models\Services;
use App\Models\Users;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServicesController extends BaseController
{

    public function listOrSingle(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'limit' => 'nullable|integer',
            'keyword' => 'nullable|string',
            'sort_by' => 'nullable|string',
            'sort_mode' => 'nullable|in:asc,desc',
            'id' => 'nullable|string',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Get Logged-in user information
            $user = Auth::user();

            if ($user == null) {
                throw new Exception('Cannot find user', 422);
            }

            // Data sanitization
            $filter = [
                'id' => $request->id ?? '',
                'limit' => $request->limit ?? 20,
                'keyword' => $request->keyword ?? '',
                'sort_by' => $request->sort_by ?? 'id',
                'sort_mode' => $request->sort_mode ?? 'asc',
                'status' => $request->status ?? '',
                'user_id' => $request->member_id ?? $user->id,
                'company_id' => $user->company_id,
            ];

            // Get list of Single data from Repository
            $rv = ServicesRepository::listOrSingle($filter);

            return response()->json([
                isset($filter['id']) && !empty($filter['id']) ? 'service' : 'services' => $rv,
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    public function sort(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sort' => 'required|array',
                'sort.*.category_id' => 'required',
                'sort.*.id' => 'required',
                'sort.*.sort' => 'required',
            ]
        );

        if ($validator->fails()) {
            return ['status' => 500, 'errors' => $validator->errors()];
        }
        try {
            $sortData = [
                'sort' => $request->sort
            ];
            ServicesRepository::sort($sortData);
            return response()->json([
                'message' => 'Sort has been updated successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }

    }

    public function create(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'after_care' => 'nullable|string',
            'available_for' => 'required',
            'team_commission' => 'nullable',
            'team_members' => 'required|array|min:1',
            'extra_time' => 'nullable',
            'tax' => 'nullable',
            'pricing' => 'required|array',
            'pricing.*.name' => 'required|string',
            'pricing.*.price' => 'required|numeric',
        ], [
            'category_id.required' => 'Category type field is required',
            'pricing.*.name.required' => 'Name field is required',
            'pricing.*.price.required' => 'Price field is required',
            'pricing.*.price.between' => 'Price has to be numeric',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find user', 422);
            }

            // Data sanitization
            $serviceData = [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description ?? null,
                'after_care' => $request->after_care ?? null,
                'company_user_id' => $user->id,
                'available_for' => $request->available_for,
                'extra_time' => $request->extra_time,
                'online_booking' => $request->online_booking,
                'type' => $request->type,
                'tax' => $request->tax,
                'pricing' => $request->pricing,
                'team_commission' => $request->team_commission,
                'team_members' => $request->team_members,
                'company_id' => $user->company_id,
            ];

            // create data from repository
            $service = ServicesRepository::create($serviceData);
            return response()->json([
                'service' => $service,
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
            'id' => 'required',
            'name' => 'required|string',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'after_care' => 'nullable|string',
            'available_for' => 'required',
            'team_commission' => 'nullable',
            'team_members' => 'required|array|min:1',
            'extra_time' => 'nullable',
            'tax' => 'nullable',
            'pricing' => 'required|array',
            'pricing.*.name' => 'required|string',
            'pricing.*.price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find user', 422);
            }

            // Get Service information
            $serviceInfo = CatelougeServices::find($request->id);

            // Throw error if service not found
            if ($serviceInfo == null) {
                throw new Exception('Cannot find service', 422);
            }

            // Data sanitization
            $serviceData = [
                'id' => $request->id,
                'name' => $request->name ?? $serviceInfo->name,
                'category_id' => $request->category_id ?? $serviceInfo->category_id,
                'description' => $request->description ?? $serviceInfo->description,
                'after_care' => $request->after_care ?? $serviceInfo->after_care,
                'available_for' => $request->available_for ?? $serviceInfo->after_care,
                'extra_time' => $request->extra_time ?? $serviceInfo->extra_time,
                'online_booking' => $request->online_booking ?? $serviceInfo->online_booking,
                'type' => $request->type ?? $serviceInfo->type,
                'team_commission' => $request->team_commission ?? 2,
                'team_members' => $request->team_members ?? [],
                'tax' => $request->tax ?? $serviceInfo->tax,
                'pricing' => $request->pricing ?? $serviceInfo->pricing,
            ];

            // create data from repository
            $service = ServicesRepository::update($serviceData, $serviceInfo);
            return response()->json([
                'service' => $service,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @param $service_id
     * @param $member_id
     * @return JsonResponse
     */
    public function removeMember(Request $request, $service_id, $member_id): JsonResponse
    {
        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find Logged-in user', 422);
            }

            // Get Service information
            $serviceInfo = CatelougeServices::find($service_id);

            // Throw error if service not found
            if ($serviceInfo == null) {
                throw new Exception('Cannot find service', 422);
            }

            // Get team member
            $teamMember = ServiceMembers::where('service_id', $service_id)->where('member_id', $member_id);

            // Throw error if team member not found
            if ($teamMember == null) {
                throw new Exception('Cannot find team member', 422);
            }
            if (!$teamMember->delete()) {
                throw new Exception('Cannot delete team member', 422);
            }

            return response()->json([
                'message' => 'Team member deleted successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @param $service_id
     * @param $member_id
     * @return JsonResponse
     */
    public function addMember(Request $request, $service_id, $member_id): JsonResponse
    {
        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find Logged-in user', 422);
            }

            // Get Service information
            $serviceInfo = CatelougeServices::find($service_id);

            // Throw error if service not found
            if ($serviceInfo == null) {
                throw new Exception('Cannot find service', 422);
            }

            // Get team member
            $teamMember = ServiceMembers::where('service_id', $service_id)->where('member_id', $member_id);

            // Throw error if team member not found
            if (!$teamMember == null) {
                throw new Exception('Team member already exists', 422);
            }

            // Save member
            $serviceMember = new ServiceMembers();
            $serviceMember->service_id = $service_id;
            $serviceMember->member_id = $member_id;
            if (!$serviceMember->save()) {
                throw new Exception('Cannot add member', 422);
            }

            return response()->json([
                'message' => 'Team member added successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }


    /**
     * @throws Exception
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get Service information
            $serviceInfo = CatelougeServices::find($request->id);

            // Throw error if service not found
            if ($serviceInfo == null) {
                throw new Exception('Cannot find service', 422);
            }
            $serviceInfo->delete();
            return response()->json([
                'message' => 'User has  been deleted permanently'
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }


    }

    public function serviceList(): JsonResponse
    {
        $services = Services::all();
        return response()->json(['services' => $services], 200);
    }
}
