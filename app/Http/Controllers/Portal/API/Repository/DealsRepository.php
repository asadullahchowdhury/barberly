<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\DealMembers;
use App\Models\DealMemberships;
use App\Models\DealProducts;
use App\Models\Deals;
use App\Models\DealServices;
use App\Models\Users;
use Exception;

class DealsRepository
{

    /**
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public static function list(array $filter): mixed
    {
        $rv = Deals::with(['services','members'])->where('company_id', $filter['company_id']);
        // If ID exist then return single data
        if (isset($filter['id']) && !empty($filter['id'])) {
            $deal = $rv->find($filter['id']);
            if ($deal == null) {
                throw new Exception('Cannot find deal', 404);
            }
            return $deal;
        }

        // else return list
        $rv->orderBy($filter['sort_by'], $filter['sort_mode']);

        // If keyword is not empty then return based on keyword
        if (!empty($filter['keyword'])) {
            $rv->where(function ($q) use ($filter) {
                $q->where('name', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('description', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('type', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        // if status is not empty then get data based on status
        if (!empty($filter['status'])) {
            $rv->where('status', $filter['status']);
        }
        // if type is not empty then get data based on type
        if (!empty($filter['type'])) {
            $rv->where('type', $filter['type']);
        }
        return $rv->paginate($filter['limit']);
    }

    /**
     * @param array $dealData
     *
     * @return Deals
     * @throws Exception
     */
    public static function create(array $dealData): Deals
    {
        $deal = new Deals();
        $deal->name = $dealData['name'];
        $deal->type = $dealData['type'];
        $deal->description = $dealData['description'];
        $deal->gift_card = $dealData['gift_card'];
        $deal->start_date = $dealData['start_date'];
        $deal->end_date = $dealData['end_date'];
        $deal->company_id = $dealData['company_id'];
        $deal->promotion_value = $dealData['promotion_value'];
        $deal->promotion_type = $dealData['promotion_type'];
        $deal->check_limit_per_client = $dealData['check_limit_per_client'];
        $deal->limit_uses = $dealData['limit_uses'];
        $deal->set_minimum_amount = $dealData['set_minimum_amount'];
        $deal->minimum_amount = $dealData['minimum_amount'];
        $deal->enable_point_of_sale = $dealData['enable_point_of_sale'];
        $deal->enable_discount = $dealData['enable_discount'];
        $deal->discount_code = $dealData['discount_code'];
        $deal->appointment_time = $dealData['appointment_time'];
        $deal->appointment_type = $dealData['appointment_type'];
        if (!$deal->save()) {
            throw new Exception('Cannot save deal', 422);
        }

        /*Add services*/
        if (!empty($dealData['services']) && count($dealData['services']) > 0) {
            $services = self::saveServices($dealData['services'], $dealData['company_id'], $dealData['user_id'], $deal->id);
            $deal['services'] = $services;
        }

        /*Add products*/
        if (!empty($dealData['products']) && count($dealData['products']) > 0) {
            $products = self::saveProducts($dealData['products'], $dealData['company_id'], $dealData['user_id'], $deal->id);
            $deal['products'] = $products;
        }


        /*Add memberships*/
        if (!empty($dealData['memberships']) && count($dealData['memberships']) > 0) {
            $memberships = self::saveMemberships($dealData['memberships'], $dealData['company_id'], $dealData['user_id'], $deal->id);
            $deal['memberships'] = $memberships;
        }

        /*Add members*/
        if (!empty($dealData['members']) && count($dealData['members']) > 0) {
            $members = self::saveMembers($dealData['members'], $dealData['company_id'], $dealData['user_id'], $deal->id);
            $deal['members'] = $members;
        }

        return $deal;
    }

    /**
     * @throws Exception
     */
    public static function saveServices($services, $company_id, $user_id, $deal_id): array
    {
        $savedServices = [];
        foreach ($services as $service) {
            $newServices = DealServices::where('company_id', $company_id)->where('service_id', $service)->where('deal_id', $deal_id)->first();
            if ($newServices == null) {
                $rv = self::createServices($service,$company_id,$user_id,$deal_id);
                $savedServices[] = $rv;
            }
        }
        return $savedServices;
    }

    /**
     * @throws Exception
     */
    public static function createServices($service, $company_id, $user_id, $deal_id): DealServices
    {
        $newServices = new DealServices();
        $newServices->company_id = $company_id;
        $newServices->created_by = $user_id;
        $newServices->deal_id = $deal_id;
        $newServices->service_id = $service;
        if (!$newServices->save()) {
            throw new Exception('Cannot save services', 422);
        };
        return $newServices;
    }
    /**
     * @throws Exception
     */
    public static function saveProducts($products, $company_id, $user_id, $deal_id): array
    {
        $savedProducts = [];
        foreach ($products as $product) {
            $newProducts = DealProducts::where('company_id', $company_id)->where('product_id', $product)->where('deal_id', $deal_id)->first();
            if ($newProducts == null) {
                $newProducts = new DealProducts();
                $newProducts->company_id = $company_id;
                $newProducts->created_by = $user_id;
                $newProducts->deal_id = $deal_id;
                $newProducts->product_id = $product;
                if (!$newProducts->save()) {
                    throw new Exception('Cannot save products', 422);
                };
                $savedProducts[] = $newProducts;
            }
        }
        return $savedProducts;
    }

    /**
     * @throws Exception
     */
    public static function saveMemberships($memberships, $company_id, $user_id, $deal_id): array
    {
        $savedMembership = [];
        foreach ($memberships as $membership) {
            $newMembership = DealMemberships::where('company_id', $company_id)->where('membership_id', $membership)->where('deal_id', $deal_id)->first();
            if ($newMembership == null) {
                $newMembership = new DealMemberships();
                $newMembership->company_id = $company_id;
                $newMembership->created_by = $user_id;
                $newMembership->deal_id = $deal_id;
                $newMembership->membership_id = $membership;
                if (!$newMembership->save()) {
                    throw new Exception('Cannot save membership', 422);
                };
                $savedMembership[] = $newMembership;
            }
        }
        return $savedMembership;
    }

    /**
     * @throws Exception
     */
    public static function saveMembers($members, $company_id, $user_id, $deal_id): array
    {
        $savedMembers = [];
        foreach ($members as $member) {
            $newMember = DealMembers::where('company_id', $company_id)->where('member_id', $member)->where('deal_id', $deal_id)->first();
            if ($newMember == null) {
                $newMember = new DealMembers();
                $newMember->company_id = $company_id;
                $newMember->created_by = $user_id;
                $newMember->deal_id = $deal_id;
                $newMember->member_id = $member;
                if (!$newMember->save()) {
                    throw new Exception('Cannot save member', 422);
                };
                $savedMembers[] = $newMember;
            }
        }
        return $savedMembers;
    }
    /**
     * @throws Exception
     */
    public static function createMembers($member, $company_id, $user_id, $deal_id): DealMembers
    {
        $newServices = new DealMembers();
        $newServices->company_id = $company_id;
        $newServices->created_by = $user_id;
        $newServices->deal_id = $deal_id;
        $newServices->member_id = $member;
        if (!$newServices->save()) {
            throw new Exception('Cannot save services', 422);
        };
        return $newServices;
    }

    /**
     * @param array $dealData
     * @param Deals $deal
     * @return Deals
     * @throws Exception
     */
    public static function update(array $dealData, Deals $deal): Deals
    {
        $deal->name = $dealData['name'];
        $deal->type = $dealData['type'];
        $deal->description = $dealData['description'];
        $deal->gift_card = $dealData['gift_card'];
        $deal->start_date = $dealData['start_date'];
        $deal->end_date = $dealData['end_date'];
        $deal->company_id = $dealData['company_id'];
        $deal->promotion_value = $dealData['promotion_value'];
        $deal->promotion_type = $dealData['promotion_type'];
        $deal->check_limit_per_client = $dealData['check_limit_per_client'];
        $deal->limit_uses = $dealData['limit_uses'];
        $deal->set_minimum_amount = $dealData['set_minimum_amount'];
        $deal->minimum_amount = $dealData['minimum_amount'];
        $deal->enable_point_of_sale = $dealData['enable_point_of_sale'];
        $deal->enable_discount = $dealData['enable_discount'];
        $deal->discount_code = $dealData['discount_code'];
        $deal->appointment_time = $dealData['appointment_time'];
        $deal->appointment_type = $dealData['appointment_type'];
        if (!$deal->save()) {
            throw new Exception('Cannot save deal', 422);
        }
        return $deal;
    }

    /**
     * @throws Exception
     */
    public static function status(array $dealData, Deals $deal): Deals
    {
        $deal->status = $dealData['status'];
        if (!$deal->save()) {
            throw new Exception('Cannot save deal', 422);
        }
        return $deal;
    }
    /**
     * @throws Exception
     */
    public static function removeExtra(array $dealData, Deals $deal): Deals
    {
        /*Services*/
        if($dealData['type'] == 'services'){
            $service = DealServices::where('deal_id', $deal->id)->where('service_id', $dealData['id'])->first();
            if($service == null){
                throw new Exception('Cannot find service', 422);
            }
            if(!$service->delete()){
                throw new Exception('Cannot delete service', 422);
            }
        }
        /*Members*/
        if($dealData['type'] == 'members'){
            $member = DealMembers::where('deal_id', $deal->id)->where('member_id', $dealData['id'])->first();
            if($member == null){
                throw new Exception('Cannot find member', 422);
            }
            if(!$member->delete()){
                throw new Exception('Cannot delete member', 422);
            }
        }
        /*MemberShips*/
        if($dealData['type'] == 'memberships'){
            $memberShip = DealMemberships::where('deal_id', $deal->id)->where('membership_id',$dealData['id'])->first();
            if($memberShip == null){
                throw new Exception('Cannot find membership', 422);
            }
            if(!$memberShip->delete()){
                throw new Exception('Cannot delete membership', 422);
            }
        }
        /*Products*/
        if($dealData['type'] == 'products'){
            $product = DealProducts::where('deal_id', $deal->id)->where('product_id', $dealData['id']);
            if($product == null){
                throw new Exception('Cannot find product', 422);
            }
            if(!$product->delete()){
                throw new Exception('Cannot delete product', 422);
            }
        }
        return $deal;
    }

    /**
     * @throws Exception
     */
    public static function addExtra(array $dealData, Deals $deal): Deals
    {
        /*Services*/
        if($dealData['type'] == 'services'){
            $service = DealServices::where('deal_id', $deal->id)->where('service_id',$dealData['id'])->first();
            if($service != null){
                throw new Exception('Service already exist', 422);
            }
            self::createServices($dealData['id'], $dealData['company_id'], $dealData['user_id'], $deal->id);
        }
        /*Members*/
        if($dealData['type'] == 'members'){
            $member = DealMembers::where('deal_id', $deal->id)->where('member_id',$dealData['id'])->first();
            if($member != null){
                throw new Exception('Member already exist', 422);
            }
            self::createServices($dealData['id'], $dealData['company_id'], $dealData['user_id'], $deal->id);
        }
        /*MemberShips*/
        if($dealData['type'] == 'memberships'){
            $memberShip = DealMemberships::where('deal_id', $deal->id)->find($dealData['id']);
            if($memberShip == null){
                throw new Exception('Cannot find membership', 422);
            }
            if(!$memberShip->delete()){
                throw new Exception('Cannot delete membership', 422);
            }
        }
        /*Products*/
        if($dealData['type'] == 'products'){
            $product = DealProducts::where('deal_id', $deal->id)->find($dealData['id']);
            if($product == null){
                throw new Exception('Cannot find product', 422);
            }
            if(!$product->delete()){
                throw new Exception('Cannot delete product', 422);
            }
        }
        return $deal;
    }

}
