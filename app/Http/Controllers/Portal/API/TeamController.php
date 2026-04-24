<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Global\MediaRepository;
use App\Http\Controllers\Portal\API\Repository\TeamRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\Media;
use App\Models\Users;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeamController extends BaseController
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
                'sort_mode' => $request->sort_mode ?? 'asc',
                'status' => $request->status ?? '',
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ];

            // Get list of Single data from Repository
            $rv = TeamRepository::list($filter);

            return response()->json([
                isset($filter['id']) && !empty($filter['id']) ? 'member' : 'members' => $rv,
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'color' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'avatar' => 'nullable|string',
            'notes' => 'nullable|string',
            'job_title' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get User information from session
            $user = Auth::user();

            // create random 12 char password
            $password = Str::random(12);

            // Create unique token
            $activation_token = md5(uniqid(uniqid(), true));
            // Set all data
            $memberData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'color' => $request->color,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'company_id' => $user->company_id,
                'end_date' => date('Y-m-d', strtotime($request->end_date)) ?? null,
                'avatar' => $request->avatar ?? null,
                'notes' => $request->notes ?? null,
                'job_title' => $request->job_title ?? null,
                'password' => bcrypt($password),
                'verified_token' => $activation_token,
                'country' => $user->country ?? null,
                'timezone' => $user->timezone ?? null,
                'currency' => $user->currency ?? null,
                'language' => $user->language ?? null,
                'status' => 1,
                'user_type' => 2,
            ];

            // create data from repository
            $member = TeamRepository::create($memberData);

            return response()->json([
                'member' => [
                    'id' => $member['id'],
                    'first_name' => $member['first_name'],
                    'last_name' => $member['last_name'],
                    'email' => $member['email'],
                    'color' => $member['color'],
                    'mobile' => $member['mobile'],
                    'status' => $member['status'],
                    'avatar' => $member['avatar'],
                ],
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
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'color' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $request->id,
            'mobile' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'avatar' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'nullable|integer',
            'job_title' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Logged-in user information
            $user = Auth::user();

            // Get member information
            $member = Users::where('company_id', $user->company_id)->find($request->id);

            $start_date = null;
            if(!empty($request->start_date) && $request->start_date != null){
                $start_date = date('Y-m-d', strtotime($request->start_date));
            }
            $end_date = null;
            if(!empty($request->end_date) && $request->end_date != null){
                $end_date = date('Y-m-d', strtotime($request->end_date));
            }

            // Set all data
            $memberData = [
                'id' => $request->id,
                'first_name' => $request->first_name ?? $member->first_name,
                'last_name' => $request->last_name ?? $member->last_name,
                'color' => $request->color ?? $member->color,
                'email' => $request->email ?? $member->email,
                'mobile' => $request->mobile ?? $member->mobile,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'avatar' => $request->avatar ?? $member->avatar,
                'notes' => $request->notes ?? $member->notes,
                'status' => $request->status ?? $member->status,
                'job_title' => $request->job_title ?? $member->job_title,
            ];

            if ($member == null) {
                throw new Exception('Cannot find member', 404);
            }

            // update data from repository
            $member = TeamRepository::update($memberData, $member);

            return response()->json([
                'member' => [
                    'id' => $member['id'],
                    'first_name' => $member['first_name'],
                    'last_name' => $member['last_name'],
                    'email' => $member['email'],
                    'color' => $member['color'],
                    'mobile' => $member['mobile'],
                    'status' => $member['status'],
                    'avatar' => $member['avatar'],
                    'notes' => $member['notes'],
                    'start_date' => $member['start_date'],
                    'end_date' => $member['end_date'],
                    'job_title' => $member['job_title'],
                ],
            ]);
        } catch (\Exception $e) {
            dd($e);
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
            // Get Logged-in user information
            $user = Auth::user();

            // Get member information
            $member = Users::where('company_id', $user->company_id)->where('user_type', 2)->find($request->id);
            if ($member == null) {
                throw new Exception('Cannot find member', 404);
            }
            $member->delete();
            return response()->json([
                'message' => 'User has  been deleted permanently'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
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

        $statusData = [
            'id' => $request->id,
            'status' => $request->status,
        ];
        try {
            TeamRepository::status($statusData);
            return response()->json([
                'message' => 'User status has been updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

}
