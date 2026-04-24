<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\BookingRepository;
use App\Http\Controllers\Portal\API\Repository\MarketPlaceProfileRepository;
use App\Http\Controllers\Portal\API\Repository\TeamRepository;
use App\Models\Bookings;
use App\Models\BookingsItems;
use App\Models\Categories;
use App\Models\CatelougeServices;
use App\Models\CompaniesPhotos;
use App\Models\Customers;
use App\Models\MarketPlaceProfiles;
use App\Models\OpeningHours;
use App\Models\Pricing;
use App\Models\Services;
use App\Models\Users;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MarketPlaceProfileController extends BaseController
{
    private MarketPlaceProfileRepository $marketPlaceProfileRepository;

    public function __construct(MarketPlaceProfileRepository $marketPlaceProfileRepository)
    {
        $this->marketPlaceProfileRepository = $marketPlaceProfileRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function create(Request $request): JsonResponse
    {
        DB::beginTransaction();

        // Get Logged-in user information from session
        $user = Auth::user();

        if ($user == null) {
            throw new Exception('Cannot find Logged-in user', 404);
        }

        $validator = Validator::make($request->all(), [
            'location_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'services_for' => 'nullable',
            'description' => 'required|string|min:200',
            'address' => 'nullable|string',
            'apt' => 'nullable|string',
            'district' => 'nullable|string',
            'city' => 'nullable|string',
            'region' => 'nullable|string',
            'postcode' => 'nullable|string',
            'country' => 'nullable|string',
            'status' => 'nullable|integer',

            'days' => isset($request->days) ? 'required|array' : 'nullable',

            'days*.shifts' =>  isset($request->days) ? 'required|array' : 'nullable',
            'days*.shifts*.start_time' => isset($request->days) ? 'required|date_format:H:i' : 'nullable',
            'days*.shifts*.end_time' =>  isset($request->days) ? 'required|date_format:H:i' : 'nullable',

            'days*.day_status' =>  isset($request->days) ? 'required' : 'nullable',
            'days*.status' =>  isset($request->days) ? 'required' : 'nullable',
            'days*.name' =>  isset($request->days) ? 'required' : 'nullable',
        ]);

        if ($validator->fails()) {
            DB::rollBack();
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {

            // Set all data
            $marketPlaceProfileData = [
                'company_id' => $user->company_id,
                'location_name' => $request->location_name ?? '',
                'phone' => $request->phone ?? '',
                'email' => $request->email ?? '',
                'services_for' => $request->services_for ?? '',
                'description' => $request->description ?? '',
                'address' => $request->address ?? '',
                'apt' => $request->apt ?? '',
                'district' => $request->district ?? '',
                'city' => $request->city ?? '',
                'region' => $request->region ?? '',
                'postcode' => $request->postcode ?? '',
                'country' => $request->country ?? '',
                'status' => $request->status ?? 2,
                'days' => $request->days ?? [],
            ];

            $marketPlaceProfile = MarketPlaceProfiles::where('company_id', $user->company_id)->first();
            if ($marketPlaceProfile != null) {
                throw new Exception('You already have a profile. you can not create another one.', 422);
            }
            // Create market profile data from repository
            $marketPlaceProfile = $this->marketPlaceProfileRepository->create($marketPlaceProfileData);

            DB::commit();
            return response()->json([
                'marketplace' => $marketPlaceProfile
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function update(Request $request): JsonResponse
    {
        DB::beginTransaction();

        // Get Logged-in user information from session
        $user = Auth::user();

        if ($user == null) {
            throw new Exception('Cannot find Logged-in user', 404);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'location_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'services_for' => 'nullable',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'apt' => 'nullable|string',
            'district' => 'nullable|string',
            'city' => 'nullable|string',
            'region' => 'nullable|string',
            'postcode' => 'nullable|string',
            'country' => 'nullable|string',
            'status' => 'nullable|integer',

            'days' => isset($request->days) ? 'required|array' : 'nullable',

            'days*.id' =>  isset($request->days) ? 'required' : 'nullable',
            'days*.shifts' =>  isset($request->days) ? 'required|array' : 'nullable',
            'days*.shifts*.start_time' => isset($request->days) ? 'required|date_format:H:i' : 'nullable',
            'days*.shifts*.end_time' =>  isset($request->days) ? 'required|date_format:H:i' : 'nullable',

            'days*.day_status' =>  isset($request->days) ? 'required' : 'nullable',
            'days*.status' =>  isset($request->days) ? 'required' : 'nullable',
            'days*.name' =>  isset($request->days) ? 'required' : 'nullable',
        ]);

        if ($validator->fails()) {
            DB::rollBack();
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {

            // Set all data
            $marketPlaceProfileData = [
                'id' => $user->id,
                'location_name' => $request->location_name ?? '',
                'phone' => $request->phone ?? '',
                'email' => $request->email ?? '',
                'services_for' => $request->services_for ?? '',
                'description' => $request->description ?? '',
                'address' => $request->address ?? '',
                'apt' => $request->apt ?? '',
                'district' => $request->district ?? '',
                'city' => $request->city ?? '',
                'region' => $request->region ?? '',
                'postcode' => $request->postcode ?? '',
                'country' => $request->country ?? '',
                'status' => $request->status ?? 2,
                'days' => $request->days ?? [],
            ];

            $marketPlaceProfile = MarketPlaceProfiles::where('company_id', $user->company_id)->where('id', $request->id)->first();
            if ($marketPlaceProfile == null) {
                throw new Exception('Profile not found', 422);
            }
            // Create market profile data from repository
            $marketPlaceProfile = MarketPlaceProfileRepository::update($marketPlaceProfile, $marketPlaceProfileData);

            DB::commit();
            return response()->json([
                'marketplace' => $marketPlaceProfile
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function photoCreate(Request $request): JsonResponse
    {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'photo_path' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Get Logged-in user information from session
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find Logged-in user', 404);
            }

            // Set all data
            $photoData = [
                'company_id' => $user->company_id,
                'photo_path' => $request->photo_path,
            ];

            // create data from repository
            $photo = MarketPlaceProfileRepository::photoCreate($photoData);

            DB::Commit();
            return response()->json([
                'data' => $photo
            ], 201);
        } catch (\Exception $e) {
            DB::Rollback();
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function photosGet(Request $request): JsonResponse
    {

        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find Logged-in user', 404);
            }
            if ($user->company_id == null) {
                throw new Exception('User must be under a company', 404);
            }
            $photos = CompaniesPhotos::where('company_id', $user->company_id)->get()->toArray();
            return response()->json([
                'data' => $photos
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function photoDelete(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find Logged-in user', 404);
            }
            if ($user->company_id == null) {
                throw new Exception('User must be under a company', 404);
            }
            $photos = CompaniesPhotos::where('company_id', $user->company_id)->where('id', $request->id)->first();
            if($photos == null){
                throw new Exception('Cannot find photo', 404);
            }
            if(!$photos->delete()){
                throw new Exception('Cannot delete photo', 404);
            };
            return response()->json([
                'msg' => 'Photo has been deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function Single(Request $request): JsonResponse
    {
        $user = Auth::user();
        if ($user == null) {
            throw new Exception('Cannot find Logged-in user', 404);
        }
        if ($user->company_id == null) {
            throw new Exception('User must be under a company', 404);
        }
        $marketPlaceProfile = MarketPlaceProfiles::with(['photos','days'])->where('company_id', $user->company_id)->first();
        if ($marketPlaceProfile == null) {
            return response()->json([
                'status' => 2,
                'msg' => 'You do not have any profile please create to continue'
            ], 200);
        }

        return response()->json([
            'profile' => $marketPlaceProfile
        ], 200);
    }

}
