<?php

namespace App\Services;


use App\Models\Bookings;
use App\Models\MarketPlaceProfiles;
use Carbon\Carbon;

class MarketplaceService
{

    public function getAllMarketPlace($keyword = null, $type = null)
    {
        $query = MarketPlaceProfiles::with(['photos','company'])->where('status', 1);

        if ($type == 'new') {
            $result = $query->where('created_at', '>=', Carbon::now()->subDays(7))->get()->toArray();

            if (count($result) == 0) {
                $result = $query->where('created_at', '>=', Carbon::now()->subDays(14))->get()->toArray();

                if (count($result) == 0) {
                    $result = $query->where('created_at', '>=', Carbon::now()->subDays(30))->get()->toArray();

                    if (count($result) == 0) {
                        $result = $query->get()->toArray();
                    }
                }
            }
        } else if($type == 'recommended'){
            $result = $query->get()->toArray();

            foreach ($result as &$each) {
                $each['bookings'] = Bookings::where('company_id', $each['company_id'])->count();
            }

            usort($result, function ($a, $b) {
                return $b['bookings'] <=> $a['bookings'];
            });

            $result = array_slice($result, 0, 15);
        }else{
            $result = $query->get()->toArray();
        }

        // Add keyword search condition
        if ($keyword != null) {
            $result = array_filter($result, function ($item) use ($keyword) {
                return str_contains(strtolower($item['location_name']), strtolower($keyword));
            });
        }

        return $result;
    }



    public function getMarketplaceById($id)
    {
        return MarketPlaceProfiles::with(['photos','services','company','teams','days'])->findOrFail($id);
    }
}
