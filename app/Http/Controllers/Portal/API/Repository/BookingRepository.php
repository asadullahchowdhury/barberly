<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Bookings;
use App\Models\BookingsItems;
use Exception;
use Illuminate\Http\JsonResponse;

class BookingRepository
{

    /**
     * @param array $filter
     * @return mixed
     * @throws Exception
     */
    public static function Single(array $filter):mixed
    {
        $booking = Bookings::with(['team_member','customer','items'])->where('company_id', $filter['company_id'])->where('id', $filter['booking_id'])->first();
        if($booking == null){
            throw new Exception('Cannot find booking', 404);
        }
        return $booking;
    }

    /**
     * @param array $bookingData
     *
     * @return Bookings
     * @throws Exception
     */
    public static function create(array $bookingData): Bookings
    {
        $booking = new Bookings();
        $booking->fill($bookingData);

        if (!$booking->save()) {
            throw new Exception('Cannot save booking', 422);
        }
        foreach ($bookingData['booking_items'] as &$item){
            $item['booking_id'] = $booking->id;
            $bookingItems = new BookingsItems();
            $bookingItems->fill($item);
            if (!$bookingItems->save()) {
                throw new Exception('Cannot save booking item', 422);
            }
        }
        return $booking;
    }

    /**
     * @param array $bookingService
     * @return BookingsItems
     * @throws Exception
     */
    public static function addService(array $bookingService): BookingsItems
    {
        $bookingItems = new BookingsItems();
        $bookingItems->fill($bookingService);
        if (!$bookingItems->save()) {
            throw new Exception('Cannot save booking item', 422);
        }
        return $bookingItems;
    }
}
