<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Global\MediaRepository;
use App\Http\Controllers\Portal\API\Repository\ResourcesRepository;
use App\Models\Media;
use App\Models\Resources;
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

class ResourcesController extends BaseController
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
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ];

            // Get list of Single data from Repository
            $rv = ResourcesRepository::listOrSingle($filter);

            return response()->json([
                isset($filter['id']) && !empty($filter['id']) ? 'resource' : 'resources' => $rv,
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
            'name' => 'required|string',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get User information from session
            $user = Auth::user();


            // Set all data
            $resourceData = [
                'name' => $request->name,
                'description' => $request->description,
                'company_id' => $user->company_id,
            ];

            // create data from repository
            $resource = ResourcesRepository::create($resourceData);

            return response()->json([
                'resource' => [
                    'id' => $resource['id'],
                    'first_name' => $resource['name'],
                    'last_name' => $resource['description'],
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
            'name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Logged-in user information
            $user = Auth::user();

            // Get member information
            $resource = Resources::where('company_id', $user->company_id)->find($request->id);

            if ($resource == null) {
                throw new Exception('Cannot find resource', 404);
            }

            // Set all data
            $resourceData = [
                'id' => $request->id,
                'name' => $request->name ?? $resource->name,
                'description' => $request->description ?? $resource->description,
            ];


            // update data from repository
            $resourceModel = ResourcesRepository::update($resourceData, $resource);

            return response()->json([
                'resource' => [
                    'id' => $resourceModel['id'],
                    'name' => $resourceModel['name'],
                    'description' => $resourceModel['description'],
                ],
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
            $resource = Resources::where('company_id', $user->company_id)->find($request->id);
            if ($resource == null) {
                throw new Exception('Cannot find resource', 404);
            }
            $resource->delete();
            return response()->json([
                'message' => 'Resource has  been deleted permanently'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }


}
