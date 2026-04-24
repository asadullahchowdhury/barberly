<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Bookings;
use App\Models\Categories;

use App\Models\CatelougeServices;
use App\Models\Customers;

use App\Models\Services;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardRepository
{
    /**
     *
     * @param array $filter
     * @return array
     */
    public static function dashboard(array $filter): array
    {
        $rv = [];

        // Get catalogue count
        $catalogue = Categories::with('services')->where('company_user_id', $filter['user_id'])->get()->toArray();
        $servicesArray = array_column($catalogue,'services');
        $allServices = array_merge(...$servicesArray);
        $rv['catalogue'] = count($catalogue);
        $rv['services'] = count($allServices);

        // Get total booking count
        $booking = Bookings::where('company_id', $filter['company_id'])->get()->toArray();
        $rv['total_bookings'] = count($booking);

        // Get today's booking count
        $rv['today_bookings'] = 0;
        if ($rv['total_bookings'] > 0) {
            $currentDate = date('Y-m-d'); // Get the current date in 'Y-m-d' format

            foreach ($booking as $eachBooking) {
                $bookingDate = substr($eachBooking['booking_date'], 0, 10); // Extract the date part

                if ($bookingDate === $currentDate) {
                    $rv['today_bookings']++;
                }
            }
        }




        // Get customers count
        $rv['customers'] = Customers::where('company_id', $filter['company_id'])->count();

        // Get team count
        $rv['team'] = Users::where('company_id', $filter['company_id'])
            ->where('user_type', 2)
            ->count();

        return $rv;

    }
}
