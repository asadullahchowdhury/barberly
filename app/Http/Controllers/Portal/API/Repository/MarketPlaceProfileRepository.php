<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Bookings;
use App\Models\BookingsItems;
use App\Models\CompaniesPhotos;
use App\Models\MarketPlaceProfiles;
use App\Models\OpeningHours;
use Exception;
use Illuminate\Http\JsonResponse;

class MarketPlaceProfileRepository
{

    /**
     * @param array $marketProfileData
     *
     * @return MarketPlaceProfiles
     * @throws Exception
     */
    public static function create(array $marketProfileData): MarketPlaceProfiles
    {
        $marketProfile = new MarketPlaceProfiles($marketProfileData);
        $marketProfile->company_id = $marketProfileData['company_id'];

        if (!$marketProfile->save()) {
            throw new \Exception('Cannot save profile', 422);
        }
        (new MarketPlaceProfileRepository)->openingHours($marketProfile, $marketProfileData['days']);

        return $marketProfile;
    }

    /**
     * @param array $marketProfileData
     *
     * @return MarketPlaceProfiles
     * @throws Exception
     */
    public static function update(MarketPlaceProfiles $marketProfile, array $marketProfileData): MarketPlaceProfiles
    {
        $marketProfile->location_name = $marketProfileData['location_name'];
        $marketProfile->phone = $marketProfileData['phone'];
        $marketProfile->email = $marketProfileData['email'];
        $marketProfile->services_for = $marketProfileData['services_for'];
        $marketProfile->description = $marketProfileData['description'];
        $marketProfile->address = $marketProfileData['address'];
        $marketProfile->apt = $marketProfileData['apt'];
        $marketProfile->district = $marketProfileData['district'];
        $marketProfile->city = $marketProfileData['city'];
        $marketProfile->region = $marketProfileData['region'];
        $marketProfile->postcode = $marketProfileData['postcode'];
        $marketProfile->country = $marketProfileData['country'];
        $marketProfile->status = $marketProfileData['status'];
        if (!$marketProfile->save()) {
            throw new \Exception('Cannot save profile', 422);
        }
        (new MarketPlaceProfileRepository)->openingHours($marketProfile, $marketProfileData['days']);

        return $marketProfile;
    }

    /**
     * @param array $photoData
     * @return CompaniesPhotos
     * @throws Exception
     */
    public static function photoCreate(array $photoData): CompaniesPhotos
    {
        $photo = new CompaniesPhotos();
        $photo->company_id = $photoData['company_id'];
        $photo->photo_path = $photoData['photo_path'];

        if (!$photo->save()) {
            throw new \Exception('Cannot save photo', 422);
        }

        return $photo;
    }

    private function openingHours(MarketPlaceProfiles $marketProfile, array $days): void
    {
        foreach ($days as $day) {
            foreach ($day['shifts'] as $shift) {
                $openingHour = null;
                if (isset($day['id']) && !empty($day['id'])) {
                    $openingHour = OpeningHours::where('id', $day['id']);
                }

                if ($openingHour == null) {
                    $openingHour = new OpeningHours();
                }

                $openingHour[$day['name']] = $day['day_status'];
                $openingHour->company_id = $marketProfile->company_id;
                $openingHour->status = $day['status'];
                $openingHour->start_time = $shift['start_time'];
                $openingHour->end_time = $shift['end_time'];
                $openingHour->save();
            }
        }
    }
}
