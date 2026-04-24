<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Users;
use Exception;

class TeamRepository
{

    /**
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public static function list(array $filter): mixed
    {
        $rv = Users::where('company_id', $filter['company_id']);

        // If ID exist then return single data
        if(isset($filter['id']) && !empty($filter['id'])){
            $member = $rv->find($filter['id']);
            if($member == null){
                throw new Exception('Cannot find member', 404);
            }
            return $member;
        }

        // else return list
        $rv->select('id','first_name', 'last_name','start_date','end_date', 'avatar', 'color','mobile','email', 'status')->orderBy($filter['sort_by'], $filter['sort_mode']);

        // If keyword is not empty then return based on keyword
        if (!empty($filter['keyword'])) {
            $rv->where(function ($q) use ($filter) {
                $q->where('first_name', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('last_name', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('email', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('mobile', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        // if status is not empty then get data based on status
        if (!empty($filter['status'])) {
            $rv->where('status', $filter['status']);
        }
        return $rv->paginate($filter['limit']);
    }

    /**
     * @param array $memberData
     *
     * @return Users
     * @throws Exception
     */
    public static function create(array $memberData): Users
    {
        $member = new Users();
        $member->first_name = $memberData['first_name'];
        $member->last_name = $memberData['last_name'];
        $member->color = $memberData['color'];
        $member->email = $memberData['email'];
        $member->mobile = $memberData['mobile'];
        $member->start_date = $memberData['start_date'];
        $member->company_id = $memberData['company_id'];
        $member->end_date = $memberData['end_date'];
        $member->avatar = $memberData['avatar'];
        $member->notes = $memberData['notes'];
        $member->job_title = $memberData['job_title'];
        $member->password = $memberData['password'];
        $member->verified_token = $memberData['verified_token'];
        $member->country = $memberData['country'];
        $member->timezone = $memberData['timezone'];
        $member->currency = $memberData['currency'];
        $member->language = $memberData['language'];
        $member->status = $memberData['status'];
        $member->user_type = $memberData['user_type'];
        if(!$member->save()){
            throw new Exception('Cannot save member', 422);
        }
        return $member;
    }

    /**
     * @param array $memberData
     * @param Users $member
     * @return Users
     * @throws Exception
     */
    public static function update(array $memberData, Users $member): Users
    {
        $member->first_name = $memberData['first_name'];
        $member->last_name = $memberData['last_name'];
        $member->email = $memberData['email'];
        $member->color = $memberData['color'];
        $member->mobile = $memberData['mobile'];
        $member->avatar = $memberData['avatar'];
        $member->start_date = $memberData['start_date'];
        $member->end_date = $memberData['end_date'];
        $member->notes = $memberData['notes'];
        $member->status = $memberData['status'];
        $member->job_title = $memberData['job_title'];
        if(!$member->save()){
            throw new Exception('Cannot update member', 422);
        };
        return $member;
    }

}
