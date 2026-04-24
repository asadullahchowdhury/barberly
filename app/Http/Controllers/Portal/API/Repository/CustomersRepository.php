<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Companies;
use App\Models\Customers;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomersRepository
{

    /**
     * @param array $filter
     * @return mixed
     * @throws Exception
     */
    public static function listOrSingle(array $filter):mixed
    {
        $rv = Customers::where('company_id', $filter['company_id']);
        // If ID exist then return single data
        if(!empty($filter['id'])){
            $customer = $rv->find($filter['id']);
            if($customer == null){
                throw new Exception('Cannot find customer', 404);
            }
            return $customer;
        }
        $rv->orderBy($filter['sort_by'], $filter['sort_mode']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('first_name', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('last_name', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('email', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('mobile', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('country', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('timezone', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('currency', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('language', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);
    }

    /**
     * @param array $customerData
     * @return Customers
     * @throws Exception
     */
    public static function create(array $customerData):Customers
    {
        $customer = new Customers();
        $customer->first_name = $customerData['first_name'];
        $customer->last_name = $customerData['last_name'];
        $customer->email = $customerData['email'];
        $customer->avatar = $customerData['avatar'];
        $customer->password = bcrypt($customerData['password']);
        $customer->mobile = $customerData['mobile'];
        $customer->gender = $customerData['gender'];
        $customer->dob = $customerData['dob'];
        $customer->country = $customerData['country'];
        $customer->timezone = $customerData['timezone'];
        $customer->currency = $customerData['currency'];
        $customer->language = $customerData['language'];
        $customer->display_booking = $customerData['display_booking'];
        $customer->clients_info = $customerData['clients_info'];
        $customer->additional_mobile = $customerData['additional_mobile'];
        $customer->source = $customerData['source'];
        $customer->initial_login = 2;
        $customer->address_name = $customerData['address_name'];
        $customer->address = $customerData['address'];
        $customer->apartment = $customerData['apartment'];
        $customer->district = $customerData['district'];
        $customer->city = $customerData['city'];
        $customer->post_code = $customerData['post_code'];
        $customer->region = $customerData['region'];
        $customer->email_notification = $customerData['email_notification'];
        $customer->email_marketing_notification = $customerData['email_marketing_notification'];
        $customer->text_message_notification = $customerData['text_message_notification'];
        $customer->company_id = $customerData['company_id'];

        if(!$customer->save()){
            throw new Exception('Cannot save customer', 422);
        };
        $customer['password'] = Str::random(12);

        Mail::send('emails.customer-invite', ['user' => $customerData, 'sentFrom' => Auth::user()], function ($message) use ($customer) {
            $message->to($customer->email, $customer->first_name)->subject(env('APP_NAME') . 'Invitation :');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        return $customer;
    }

    /**
     * @param array $customerData
     * @param Customers $customer
     * @return Customers
     * @throws Exception
     */
    public static function update(array $customerData, Customers $customer): Customers
    {
        $customer->first_name = $customerData['first_name'];
        $customer->last_name = $customerData['last_name'];
        $customer->email = $customerData['email'];
        $customer->mobile = $customerData['mobile'];
        $customer->avatar = $customerData['avatar'];
        $customer->gender = $customerData['gender'];
        $customer->dob = $customerData['dob'];
        $customer->country = $customerData['country'];
        $customer->timezone = $customerData['timezone'];
        $customer->currency = $customerData['currency'];
        $customer->language = $customerData['language'];
        $customer->display_booking = $customerData['display_booking'];
        $customer->clients_info = $customerData['clients_info'];
        $customer->additional_mobile = $customerData['additional_mobile'];
        $customer->source = $customerData['source'];
        $customer->address_name = $customerData['address_name'];
        $customer->address = $customerData['address'];
        $customer->apartment = $customerData['apartment'];
        $customer->district = $customerData['district'];
        $customer->city = $customerData['city'];
        $customer->post_code = $customerData['post_code'];
        $customer->region = $customerData['region'];
        $customer->email_notification = $customerData['email_notification'];
        $customer->email_marketing_notification = $customerData['email_marketing_notification'];
        $customer->text_message_notification = $customerData['text_message_notification'];
        if(!$customer->save()){
            throw new Exception('Cannot update customer', 422);
        };
        return $customer;
    }


}
