<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Companies;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PortalAccountRepository
{

    /**
     * @param array $companyData
     * @param Users $user
     * @return Companies
     *  @throws Exception
     */
    public static function setupAccount(array $companyData, Users $user):Companies
    {
        // Create Company
        $company = new Companies();
        $company->user_id = $companyData['user_id'];
        $company->business_name = $companyData['business_name'];
        $company->website = $companyData['website'] ?? null;
        $company->services = $companyData['services'];
        $company->address = $companyData['address'] ?? null;
        $company->apartment = $companyData['apartment'] ?? null;
        $company->district = $companyData['district'] ?? null;
        $company->city = $companyData['city'] ?? null;
        $company->region = $companyData['region'] ?? null;
        $company->postcode = $companyData['postcode'] ?? null;
        $company->country = $companyData['country'] ?? null;
        $company->team_size = $companyData['team_size'];
        $company->is_physical = $companyData['is_physical'];
        $company->save();
        if (!$company->save()){
            throw new Exception('Cannot save company', 422);
        };

        // Add company id into user table
        $user->company_id = $company->id;
        if (!$user->save()){
            throw new Exception('Cannot update user', 422);
        };
        return $company;
    }
}
