<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Global\MediaRepository;
use App\Http\Controllers\Portal\API\Repository\CustomersRepository;
use App\Http\Controllers\Portal\API\Repository\PortalAccountRepository;
use App\Models\Customers;
use App\Models\Media;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomersController extends BaseController
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
                'company_id' => $user->company_id,
            ];   // Get list of Single data from Repository
            $rv = CustomersRepository::listOrSingle($filter);
            return response()->json([
                !empty($request->id) ? 'customer' : 'customers' => $rv
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
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|unique:customers,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // Generate random password
            $random_password = Str::random(12);

            // User Information
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }

            $customerData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $random_password,
                'mobile' => $request->mobile ?? null,
                'gender' => $request->gender ?? 4,
                'dob' => $request->dob ?? null,
                'country' => $request->country ?? null,
                'timezone' => $request->timezone ?? null,
                'currency' => $request->currency ?? null,
                'language' => $request->language ?? null,
                'display_booking' => $request->display_booking ?? null,
                'clients_info' => $request->clients_info ?? null,
                'additional_mobile' => $request->additional_mobile ?? null,
                'source' => $request->source ?? null,
                'initial_login' => 2,
                'address_name' => $request->address_name ?? null,
                'address' => $request->address ?? null,
                'apartment' => $request->apartment ?? null,
                'district' => $request->district ?? null,
                'avatar' => null,
                'city' => $request->city ?? null,
                'post_code' => $request->post_code ?? null,
                'region' => $request->region ?? null,
                'email_notification' => $request->email_notification ?? null,
                'email_marketing_notification' => $request->email_marketing_notification ?? null,
                'text_message_notification' => $request->text_message_notification ?? null,
                'company_id' => $user->company_id,
            ];
            $rv = CustomersRepository::create($customerData);
            return response()->json([
                'customer' => $rv
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

    public function update(Request $request): JsonResponse
    {
        $input = $request->input();
        $validator = Validator::make($input, [
            'id' => 'required|integer',
            'first_name' => 'required|nullable|string|min:3',
            'last_name' => 'required|nullable|string|min:3',
            'email' => 'required|nullable|email|unique:customers,email,' . $request->id,
            'mobile' => 'nullable|numeric',
            'gender' => 'nullable|numeric',
            'dob' => 'nullable|date',
            'country' => 'nullable|string',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|integer',
            'language' => 'nullable|string',
            'display_booking' => 'nullable|integer',
            'clients_info' => 'nullable|string',
            'additional_mobile' => 'nullable|numeric',
            'source' => 'nullable|string',
            'address_name' => 'nullable|string',
            'address' => 'nullable|string',
            'apartment' => 'nullable|string',
            'district' => 'nullable|string',
            'city' => 'nullable|string',
            'post_code' => 'nullable|string',
            'region' => 'nullable|string',
            'email_notification' => 'nullable|integer',
            'email_marketing_notification' => 'nullable|integer',
            'text_message_notification' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            // User Information
            $user = Auth::user();
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }

            $customer = Customers::find($request->id);
            if ($customer == null) {
                throw new Exception('Cannot find customer', 404);
            }

            $customerData = [
                'avatar' => $request->avatar ?? '',
                'first_name' => $request->first_name ?? $customer->first_name,
                'last_name' => $request->last_name ?? $customer->last_name,
                'email' => $request->email ?? $customer->email,
                'mobile' => $request->mobile ?? $customer->mobile,
                'gender' => $request->gender ?? $customer->gender,
                'dob' => $request->dob ?? $customer->dob,
                'country' => $request->country ?? $customer->country,
                'timezone' => $request->timezone ?? $customer->timezone,
                'currency' => $request->currency ?? $customer->currency,
                'language' => $request->language ?? $customer->language,
                'display_booking' => $request->display_booking ?? $customer->display_booking,
                'clients_info' => $request->clients_info ?? $customer->clients_info,
                'additional_mobile' => $request->additional_mobile ?? $customer->additional_mobile,
                'source' => $request->source ?? $customer->source,
                'address_name' => $request->address_name ?? $customer->address_name,
                'address' => $request->address ?? $customer->address,
                'apartment' => $request->apartment ?? $customer->apartment,
                'district' => $request->district ?? $customer->district,
                'city' => $request->city ?? $customer->city,
                'post_code' => $request->post_code ?? $customer->post_code,
                'region' => $request->region ?? $customer->region,
                'email_notification' => $request->email_notification ?? $customer->email_notification,
                'email_marketing_notification' => $request->email_marketing_notification ?? $customer->email_marketing_notification,
                'text_message_notification' => $request->text_message_notification ?? $customer->text_message_notification,
            ];
            $rv = CustomersRepository::update($customerData, $customer);
            return response()->json([
                'customer' => $rv
            ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
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
            if ($user == null) {
                throw new Exception('Cannot find user', 404);
            }
            // Get member information
            $customer = Customers::where('company_id', $user->company_id)->find($request->id);
            if ($customer == null) {
                throw new Exception('Cannot find customer', 404);
            }
            if (!$customer->delete()) {
                throw new Exception('Cannot delete customer', 422);
            };
            return response()->json([
                'message' => 'Customer has  been deleted permanently'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

}
