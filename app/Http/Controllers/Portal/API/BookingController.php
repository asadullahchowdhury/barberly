<?php

namespace App\Http\Controllers\Portal\API;

use App\Http\Controllers\Portal\API\Repository\BookingRepository;
use App\Http\Controllers\Portal\API\Repository\TeamRepository;
use App\Models\Bookings;
use App\Models\BookingsItems;
use App\Models\Categories;
use App\Models\CatelougeServices;
use App\Models\Customers;
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
use Illuminate\Support\Str;

class BookingController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    // Todo: Not completed
    // Confused about how should i get the data
    // Notes:
    // 1. with the booking options we need the team members too
    // 2. filters
    //     1. by day / 3 days / 1 week also can be current day to 1 week , 2 week, 3 week, 5 week, 6 week
    //     2. by company
    //     3. by team member / working / all
    // 3. blocked dates
    // 4. booked dates
    // 5. end shift data
    public function list(Request $request)
    {
        $teamMemberId = $request->input('team_member_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $user = Auth::user();
        $company_id = $user->company_id;

        $teams = Users::where('company_id', $company_id);

        if ($teamMemberId) {
            $teams = $teams->where('id', $teamMemberId)->get();
        } else {
            $teams = $teams->get();
        }

        foreach ($teams as &$member) {
            $booking_events = [];
            // Retrieve only the bookings within the specified date range
            $bookings = $member->bookings()->where(function ($query) use ($start_date, $end_date) {
                if ($start_date && $end_date) {
                    $query->whereBetween('booking_date', [$start_date, $end_date]);
                }
            })->get();

            foreach ($bookings as $booking) {
                $items = $booking->items->toArray();
                foreach ($items as $item) {

                    $booking_date = Carbon::parse($booking['booking_date'])->toDateString();

                    $item['start'] = $booking_date . 'T' . $item['start_time'];
                    $item['end'] = $booking_date . 'T' . $item['end_time'];
                    $start_time = Carbon::parse($item['start_time'])->format('H:i');
                    $end_time = Carbon::parse($item['end_time'])->format('H:i');
                    $item['time_slot'] = $start_time . ' - ' . $end_time;
                    $item['team_member_id'] = $booking['team_member_id'];
                    $item['customer'] = Customers::select('id', 'first_name', 'last_name', 'avatar')->where('id', $booking['customer_id'])->first();
                    $item['catalogue'] = Categories::select('id', 'name', 'color')->where('id', $item['catalogue_id'])->first();
                    $item['service'] = CatelougeServices::select('id', 'name')->where('id', $item['service_id'])->first();
                    $item['pricing'] = Pricing::select('id', 'name')->where('id', $item['pricing_id'])->first();
                    $item['booking_date'] = $booking['booking_date'];
                    $item['booking_id'] = $booking['id'];
                    $booking_events[] = $item;
                }
            }
            unset($member['bookings']);
            $member['booking_events'] = $booking_events;
        }
        return $teams->toArray();
    }

    /**
     * @throws Exception
     */
    public function Single(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        if ($user == null) {
            throw new Exception('Cannot find Logged-in user', 404);
        }
        $filter = [
            'booking_id' => $request->booking_id,
            'company_id' => $user->company_id,
        ];
        // Get list of Single data from Repository
        $rv = BookingRepository::Single($filter);
        if ($rv == null) {
            throw new Exception('Cannot find booking', 404);
        }

        return response()->json([
            'booking' => $rv
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer',
            'team_member_id' => 'required|integer',
            'booking_date' => 'required|date_format:Y-m-d',
            'booking_items' => 'required|array',
            'booking_items*.catalogue_id' => 'required|integer',
            'booking_items*.service_id' => 'required|integer',
            'booking_items*.pricing_id' => 'required|integer',
            'booking_items*.start_time' => 'required|date_format:H:i',
            'booking_items*.end_time' => 'required|date_format:H:i',
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

            // Todo: check if team member has shifts today

            // Todo: check if team member shift is over of not


            // check if booking date / time is available or not
            $bookingItems = BookingsItems::whereDate('created_at', $request->booking_date)->where('member_id', $request->team_member_id)->get();
            foreach ($bookingItems as $item) {
                foreach ($request->booking_items as $requestItem) {
                    $startTime = Carbon::createFromFormat('H:i', $requestItem['start_time']);
                    $endTime = Carbon::createFromFormat('H:i', $requestItem['end_time']);

                    $itemStartTime = Carbon::createFromFormat('H:i:s', $item['start_time']);
                    $itemEndTime = Carbon::createFromFormat('H:i:s', $item['end_time']);

                    $startWithinRange = $startTime->between($itemStartTime, $itemEndTime);
                    $endWithinRange = $endTime->between($itemStartTime, $itemEndTime);

                    if ($startWithinRange) {
                        return response()->json(['errors' => ['start_time' => ['Selected start time is already book']]], 422);
                    }
                    if ($endWithinRange) {
                        return response()->json(['errors' => ['end_time' => ['Selected end time is already book']]], 422);
                    }
                }
            }

            // Calculate duration and get price
            $modifiedBookingItems = [];

            if (!empty($request->booking_items) && count($request->booking_items) > 0) {
                foreach ($request->booking_items as $item) {
                    // Clone the item to avoid altering the original request
                    $modifiedItem = $item;
                    $modifiedItem['member_id'] = $request->team_member_id;

                    $start = DateTime::createFromFormat('H:i', $item['start_time']);
                    $end = DateTime::createFromFormat('H:i', $item['end_time']);

                    // Check if DateTime objects were created successfully
                    if ($start !== false && $end !== false) {
                        $interval = $start->diff($end);
                        $minutes = $interval->h * 60 + $interval->i;

                        $modifiedItem['duration'] = $minutes;

                        $modifiedItem['company_id'] = $user->company_id;
                        // Add the modified item to the new array
                        $modifiedBookingItems[] = $modifiedItem;
                    } else {
                        // Handle DateTime creation failure here
                        // For instance, you could set a default value for duration or handle the error accordingly
                        // Example:
                        $modifiedItem['duration'] = 0; // Set a default value for duration
                        // Log or handle the error regarding DateTime creation failure
                    }
                }
            }


            // Set all data
            $bookingData = [
                'company_id' => $user->company_id,
                'team_member_id' => $request->team_member_id,
                'customer_id' => $request->customer_id,
                'booking_date' => $request->booking_date,
                'created_by' => $user->id,
                'created_by_type' => $user->user_type,
                'status' => 1,
                'booking_items' => $modifiedBookingItems,
            ];

            // create data from repository
            $booking = BookingRepository::create($bookingData);

            DB::Commit();
            return response()->json([
                'booking' => $booking
            ], 201);
        } catch (\Exception $e) {
            DB::Rollback();
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
            'status' => 'required|in:1,2,3,4,5', // 1.Pending, 2.Arrived, 3.Started, 4.No-show, 5.Cancel
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $booking = Bookings::find($request->id);
        if ($booking == null) {
            throw new Exception('Cannot find booking', 404);
        }
        try {
            $booking->status = $request->status;
            $booking->save();
            return response()->json([
                'message' => 'Booking status has been updated successfully',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function cancel(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $booking = Bookings::find($request->id);
        if ($booking == null) {
            throw new Exception('Cannot find booking', 404);
        }
        try {
            $booking->delete();
            return response()->json([
                'message' => 'Booking has been cancelled successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function removeCustomer(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $booking = Bookings::find($request->id);
        if ($booking == null) {
            throw new Exception('Cannot find booking', 404);
        }
        try {
            $booking->customer_id = null;
            $booking->save();
            return response()->json([
                'message' => 'customer removed successfully',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function removeService(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $booking = BookingsItems::find($request->id);
        if ($booking == null) {
            throw new Exception('Cannot find Service', 404);
        }
        try {
            if (!$booking->delete()) {
                throw new Exception('Cannot delete service', 404);
            };
            return response()->json([
                'message' => 'service has been deleted successfully',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function addService(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|integer',
            'service_id' => 'required|integer',
            'catalogue_id' => 'required|integer',
            'pricing_id' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $booking = Bookings::find($request->booking_id);

        if ($booking == null) {
            throw new Exception('Cannot find booking', 404);
        }

        // check if booking date / time is available or not
        $bookingItems = BookingsItems::whereDate('created_at', $request->booking_date)->where('member_id', $request->team_member_id)->get();
        foreach ($bookingItems as $item) {
            $startTime = Carbon::createFromFormat('H:i', $request->start_time);
            $endTime = Carbon::createFromFormat('H:i', $request->end_time);

            $itemStartTime = Carbon::createFromFormat('H:i:s', $item['start_time']);
            $itemEndTime = Carbon::createFromFormat('H:i:s', $item['end_time']);

            $startWithinRange = $startTime->between($itemStartTime, $itemEndTime);
            $endWithinRange = $endTime->between($itemStartTime, $itemEndTime);

            if ($startWithinRange) {
                return response()->json(['errors' => ['start_time' => ['Selected start time is already book']]], 422);
            }
            if ($endWithinRange) {
                return response()->json(['errors' => ['end_time' => ['Selected end time is already book']]], 422);
            }
        }
        try {
            $bookingServices = [
                'company_id' => $booking->company_id,
                'booking_id' => $request->booking_id,
                'service_id' => $request->service_id,
                'catalogue_id' => $request->catalogue_id,
                'pricing_id' => $request->pricing_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'member_id' => $booking->member_id,
                'duration' => 0,
                'price' => 0,
            ];

            $start = DateTime::createFromFormat('H:i', $bookingServices['start_time']);
            $end = DateTime::createFromFormat('H:i', $bookingServices['end_time']);

            // Check if DateTime objects were created successfully
            if ($start !== false && $end !== false) {
                $interval = $start->diff($end);
                $minutes = $interval->h * 60 + $interval->i;

                $bookingServices['duration'] = $minutes;
            }
            $pricing = Pricing::find($bookingServices['pricing_id']);
            if (!$pricing) {
                throw new Exception('Pricing not found', 404);
            }
            $bookingServices['price'] = $pricing->price;


            // create data from repository
            $booking = BookingRepository::addService($bookingServices);
            return response()->json([
                'message' => 'service has been created successfully',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function addCustomer(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'customer_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $booking = Bookings::find($request->id);
        if ($booking == null) {
            throw new Exception('Cannot find booking', 404);
        }
        try {
            $booking->customer_id = $request->customer_id;
            $booking->save();
            return response()->json([
                'message' => 'customer added successfully',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    // Todo: Blocked time


    public function createnew(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'team_member_id' => 'required|integer',
                'customer_id' => 'required|integer',
                'created_by_type' => 'required|integer',
                'booking_date' => 'required|date_format:Y-m-d',
                'booking_items' => 'required|array',
                'booking_items.*.catalogue_id' => 'required|integer',
                'booking_items.*.service_id' => 'required|integer',
                'booking_items.*.pricing_id' => 'required|integer',
                'booking_items.*.start_time' => 'required|date_format:H:i',
                'booking_items.*.end_time' => 'required|date_format:H:i',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = Auth::user();
            if (!$user) {
                throw new Exception('Cannot find Logged-in user', 404);
            }

            // Todo: check if team member has shifts today []

            // Todo: check if team member shift is over or not

            // check if booking date / time is available or not
            $this->checkBookingAvailability($request->booking_items, $request->booking_date);

            // Calculate duration and get price
            $this->calculateBookingItemsData($request->booking_items);

            // Set all data
            $bookingData = [
                'company_id' => $user->company_id,
                'team_member_id' => $request->team_member_id,
                'customer_id' => $request->customer_id,
                'booking_date' => $request->booking_date,
                'created_by' => $user->id,
                'created_by_type' => $user->user_type,
                'status' => 1,
                'booking_items' => $request->booking_items,
            ];

            // create data from repository
            $booking = BookingRepository::create($bookingData);

            DB::commit();
            return response()->json(['booking' => $booking], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    private function checkBookingAvailability(array $bookingItems, string $bookingDate)
    {
        foreach ($bookingItems as $item) {
            $startWithinRange = BookingItem::where('booking_date', $bookingDate)
                ->where(function ($query) use ($item) {
                    $query->whereBetween('start_time', [$item['start_time'], $item['end_time']])
                        ->orWhereBetween('end_time', [$item['start_time'], $item['end_time']]);
                })
                ->exists();

            if ($startWithinRange) {
                throw new Exception('Selected time is already booked', 422);
            }
        }
    }

    /**
     * @throws Exception
     */
    private function calculateBookingItemsData(array &$bookingItems): void
    {
        foreach ($bookingItems as &$item) {
            $start = DateTime::createFromFormat('H:i:s', $item['start_time']);
            $end = DateTime::createFromFormat('H:i:s', $item['end_time']);

            $interval = $start->diff($end);
            $minutes = $interval->h * 60 + $interval->i;

            $item['duration'] = $minutes;

            $pricing = Pricing::find($item['pricing_id']);
            if (!$pricing) {
                throw new Exception('Pricing not found', 404);
            }
            $item['price'] = $pricing->price;
        }
    }


}
