<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Categories;

use App\Models\CatelougeServices;
use App\Models\Customers;

use App\Models\Memberships;
use App\Models\MembershipServices;
use App\Models\Pricing;
use App\Models\ServiceMembers;
use App\Models\Services;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MembershipsRepository
{
    /**
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public static function listOrSingle(array $filter): mixed
    {
        $rv = Memberships::with('services')->where('company_id', $filter['company_id']);
        // If ID exist then return single data
        if (isset($filter['id']) && !empty($filter['id'])) {
            $member = $rv->find($filter['id']);
            if ($member == null) {
                throw new Exception('Cannot find membership', 404);
            }
            return $member;
        }
        // else return list
        $rv->orderBy($filter['sort_by'], $filter['sort_mode']);

        // If keyword is not empty then return based on keyword
        if (!empty($filter['keyword'])) {
            $rv->where(function ($q) use ($filter) {
                $q->where('name', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('description', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }

        return $rv->paginate($filter['limit']);
    }


    /**
     * @param array $membershipData
     *
     * @return Memberships
     * @throws Exception
     */
    public static function create(array $membershipData): Memberships
    {

        $membership = new Memberships();
        $membership->fill($membershipData);

        if (!$membership->save()) {
            throw new Exception('Cannot save membership', 422);
        }

        if (count($membershipData['services']) > 0){
            foreach ($membershipData['services'] as $each) {
                $membershipService = new MembershipServices();
                $membershipService->membership_id = $membership->id;
                $membershipService->service_id = $each;
                $membershipService->company_id = $membershipData['company_id'];
                $membershipService->save();
            }
        }
        return $membership;
    }

    /**
     * @param array $membershipData
     * @param Memberships $membership
     * @return Memberships
     * @throws Exception
     */
    public static function update(array $membershipData, Memberships $membership): Memberships
    {

        $membership->fill($membershipData);
        if (!$membership->save()) {
            throw new Exception('Cannot update membership', 422);
        }
        return $membership;
    }


}
