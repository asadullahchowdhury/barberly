<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\CategoriesRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\Categories;
use App\Models\CatelougeServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     *@throws Exception
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
            'member_id' => 'nullable|string',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get Logged-in user information
            $user = Auth::user();

            if($user == null){
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
                'user_id' => $user->id,
                'member_id' => $request->member_id ?? null,
            ];

            // Get list of Single data from Repository
            $rv = CategoriesRepository::listOrSingle($filter);

            return response()->json([
                'categories' => $rv
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }
    }

    public function sort(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'sort' => 'required|array',
            'sort.*.id' => 'required',
            'sort.*.sort' => 'required',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $sortData = [
                'sort' => $request->sort
            ];

            // Update sort data from Repository
            CategoriesRepository::sort($sortData);
            return response()->json([
                'message' => 'Sort has been updated successfully'
            ],200);

        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     *@throws Exception
     */
    public function create(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'color' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = Auth::user();
            if($user === null){
                throw new Exception('Cannot find user', 404);
            }
            $categoryData = [
                'name' => $request->name,
                'color' => $request->color,
                'description' => $request->description ?? null,
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ];
            $rv = CategoriesRepository::create($categoryData);
            return response()->json([
                'category' => $rv
            ]);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
    /**
     * @param Request $request
     * @return JsonResponse
     *@throws Exception
     */
    public function update(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'nullable|string',
            'color' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $category = Categories::find($request->id);
            if($category === null){
                throw new Exception('Cannot find category', 404);
            }
            $categoryData = [
                'name' => $request->name ?? $category->name,
                'color' => $request->color ?? $category->color,
                'description' => $request->description  ?? $category->description,
            ];
            $rv = CategoriesRepository::update($categoryData, $category);
            return response()->json([
                'category' => $rv
            ]);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }


    public function delete(Request $request):JsonResponse
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
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }
            // Get category information
            $category = Categories::where('company_user_id', $user->id)->find($request->id);
            if ($category == null) {
                throw new Exception('Cannot find category', 404);
            }

            $service = CatelougeServices::where('category_id', $category->id);

            if ($service->count() > 0) {
                CatelougeServices::where('category_id', $category->id)->delete();
            }

            // Delete the category
            if (!$category->delete()) {
                throw new Exception('Cannot delete category', 422);
            }

            return response()->json([
                'message' => 'category has  been deleted permanently'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

}
