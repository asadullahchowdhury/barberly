<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Categories;

use App\Models\CatelougeServices;
use App\Models\Customers;

use App\Models\Pricing;
use App\Models\ServiceMembers;
use App\Models\Services;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServicesRepository
{
    /**
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public static function listOrSingle(array $filter): mixed
    {
       $service_ids = [];
       if(isset($filter['member_id']) && !empty($filter['member_id'])){
           $service_ids = ServiceMembers::where('member_id', $filter['member_id'])->get()->toArray();
           $service_ids = array_column($service_ids, 'service_id');
       }
        $rv = CatelougeServices::with('pricing')->where('company_user_id', $filter['user_id'])->where('id', $filter['id']);
        // If ID exist then return single data
        if (isset($filter['id']) && !empty($filter['id'])) {
            $service = $rv->find($filter['id']);
            if ($service == null) {
                throw new Exception('Cannot find service', 404);
            }
            $service['team_members'] = ServiceMembers::where('service_id', $filter['id'])->pluck('member_id');

            return $service;
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

        if(isset($filter['member_id']) && !empty($filter['member_id'])){
            if (count($service_ids) > 0) {
                $rv->where(function ($q) use ($service_ids) {
                    $q->whereIn('id', $service_ids);
                });
            }
        }


        return $rv->paginate($filter['limit']);
    }

    /**
     * @param array $sortData
     *
     * @return bool
     * @throws Exception
     */
    public static function sort(array $sortData): bool
    {
        foreach ($sortData['sort'] as $each) {
            $categoryServices = CatelougeServices::where('id', $each['id'], $each['sort'])->first();
            if ($categoryServices == null) {
                throw new Exception('Cannot find service', 404);
            }
            $categoryServices->sort = $each['sort'] ?? 0;
            $categoryServices->category_id = $each['category_id'];
            if (!$categoryServices->save()) {
                throw new Exception('Cannot save service', 422);
            };
        }
        return true;
    }

    /**
     * @param array $serviceData
     *
     * @return CatelougeServices
     * @throws Exception
     */
    public static function create(array $serviceData): CatelougeServices
    {

        $service = new CatelougeServices();
        $service->name = $serviceData['name'];
        $service->category_id = $serviceData['category_id'];
        $service->company_id = $serviceData['company_id'];
        $service->description = $serviceData['description'];
        $service->after_care = $serviceData['after_care'];
        $service->company_user_id = $serviceData['company_user_id'];
        $service->available_for = $serviceData['available_for'];
        $service->team_commission = $serviceData['team_commission'];
        $service->extra_time = $serviceData['extra_time'];
        $service->online_booking = $serviceData['online_booking'];
        $service->type = $serviceData['type'];
        $service->tax = $serviceData['tax'];

        if (!$service->save()) {
            throw new Exception('Cannot save service', 422);
        }

        foreach ($serviceData['team_members'] as $each) {
            $serviceMember = new ServiceMembers();
            $serviceMember->service_id = $service->id;
            $serviceMember->member_id = $each;
            $serviceMember->save();
        }

        foreach ($serviceData['pricing'] as $each) {
            $priceFormat = number_format($each['price'], '2', '.', '');

            $pricing = new Pricing();
            $pricing->name = $each['name'];
            $pricing->duration = $each['duration'];
            $pricing->type = $each['type'];
            $pricing->price = $priceFormat;
            $pricing->service_id = $service->id;
            $pricing->company_user_id = $service->company_user_id;
            $pricing->save();
            $service->pricing_id = $pricing->id;
            $service->save();
            if (!$pricing->save()) {
                throw new Exception('Service has been saved but unable to save pricing', 422);
            };
        }
        return $service;
    }

    /**
     * @param array $serviceData
     *
     * @return CatelougeServices
     * @throws Exception
     */
    public static function update(array $serviceData, CatelougeServices $service): CatelougeServices
    {

        $service->name = $serviceData['name'];
        $service->category_id = $serviceData['category_id'];
        $service->description = $serviceData['description'];
        $service->after_care = $serviceData['after_care'];
        $service->available_for = $serviceData['available_for'];
        $service->extra_time = $serviceData['extra_time'];
        $service->online_booking = $serviceData['online_booking'];
        $service->team_commission = $serviceData['team_commission'];
        $service->type = $serviceData['type'];
        $service->tax = $serviceData['tax'];
        if (!$service->save()) {
            throw new Exception('Cannot save service', 422);
        }

//        ServiceMembers::whereIn('member_id', $serviceData['team_members'])->delete();
//
//        foreach ($serviceData['team_members'] as $each) {
//            $serviceMember = new ServiceMembers();
//            $serviceMember->service_id = $service->id;
//            $serviceMember->member_id = $each;
//            $serviceMember->save();
//        }

        foreach ($serviceData['pricing'] as $each) {
            $priceFormat = number_format($each['price'], '2', '.', '');

            if (isset($each['id']) && !empty($each['id'])) {
                $pricing = Pricing::where('id', $each['id'])->first();
            } else {
                $pricing = new Pricing();
            }
            $pricing->name = $each['name'];
            $pricing->duration = $each['duration'];
            $pricing->type = $each['type'];
            $pricing->price = $priceFormat;
            $pricing->service_id = $service->id;
            $pricing->company_user_id = $service->company_user_id;
            $service->pricing_id = $pricing->id;
            $service->save();
            if (!$pricing->save()) {
                throw new Exception('Service has been saved but unable to save pricing', 422);
            };
        }
        return $service;
    }


}
