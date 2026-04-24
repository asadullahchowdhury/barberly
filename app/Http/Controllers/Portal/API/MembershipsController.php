<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\MembershipsRepository;
use App\Models\CatelougeServices;
use App\Models\Memberships;
use App\Models\MembershipServices;
use App\Models\Services;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MembershipsController extends BaseController
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
                throw new Exception('Cannot find Logged-in user', 422);
            }

            // Data sanitization
            $filter = [
                'id' => $request->id ?? '',
                'limit' => $request->limit ?? 20,
                'keyword' => $request->keyword ?? '',
                'sort_by' => $request->sort_by ?? 'id',
                'sort_mode' => $request->sort_mode ?? 'asc',
                'status' => $request->status ?? '',
                'company_id' => $user->company_id ?? '',
            ];

            // Get list of Single data from Repository
            $rv = MembershipsRepository::listOrSingle($filter);

            return response()->json([
                isset($filter['id']) && !empty($filter['id']) ? 'membership' : 'memberships' => $rv,
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    public function create(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'sessions' => 'required|integer',
            'session_no' => 'nullable|integer',
            'valid_for' => 'required|string',
            'price' => 'required|numeric|gt:0',
            'color' => 'required|string',
            'terms_conditions' => 'nullable|string',
            'services' => 'required|array',
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

            // calculate start_end and end_date based of current date and valid_for
            $start_date = date('Y-m-d H:i:s');
            $end_date = date('Y-m-d H:i:s', strtotime($start_date. '+'.$request->valid_for));
            // Data sanitization
            $membershipData = [
                'name' => $request->name,
                'description' => $request->description ?? null,
                'sessions' => $request->sessions ?? 1,
                'session_no' => $request->session_no ?? 5,
                'price' => $request->price ?? null,
                'valid_for' => $request->valid_for ?? '7 days',
                'start_date' => $start_date,
                'end_date' => $end_date,
                'color' => $request->color ?? null,
                'terms_conditions' => $request->terms_conditions ?? null,
                'services' => $request->services ?? [],
                'company_id' => $user->company_id,
                'created_by' => $user->id,
            ];

            // create data from repository
            $membership = MembershipsRepository::create($membershipData);
            return response()->json([
                'membership' => $membership,
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
            'description' => 'nullable|string',
            'sessions' => 'required|integer',
            'session_no' => 'nullable|integer',
            'valid_for' => 'required|string',
            'price' => 'required|numeric|gt:0',
            'color' => 'required|string',
            'terms_conditions' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find user', 422);
            }

            $membership = Memberships::find($request->id);
            if ($membership == null) {
                throw new Exception('Cannot find membership', 422);
            }

            // calculate start_end and end_date based of current date and valid_for
            $start_date = date('Y-m-d H:i:s');
            $end_date = date('Y-m-d H:i:s', strtotime($start_date. '+'.$request->valid_for));
            // Data sanitization
            $membershipData = [
                'name' => $request->name,
                'description' => $request->description ?? null,
                'sessions' => $request->sessions ?? 1,
                'session_no' => $request->session_no ?? 5,
                'price' => $request->price ?? null,
                'valid_for' => $request->valid_for ?? '7 days',
                'start_date' => $start_date,
                'end_date' => $end_date,
                'color' => $request->color ?? null,
                'terms_conditions' => $request->terms_conditions ?? null,
                'services' => $request->services ?? [],
                'company_id' => $user->company_id,
                'created_by' => $user->id,
            ];

            // create data from repository
            $membership = MembershipsRepository::update($membershipData, $membership);
            return response()->json([
                'membership' => $membership,
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
            $memberShip = Memberships::find($request->id);

            // Throw error if service not found
            if ($memberShip == null) {
                throw new Exception('Cannot find membership', 422);
            }

            MembershipServices::where('membership_id', $request->id)->delete();

            $memberShip->delete();
            return response()->json([
                'message' => 'Membership has been deleted permanently'
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
