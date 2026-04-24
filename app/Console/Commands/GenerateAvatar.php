<?php

namespace App\Console\Commands;

use App\Models\Customers;
use App\Models\Users;
use http\Client\Curl\User;
use Illuminate\Console\Command;

class GenerateAvatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Generate:Avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        print_r("".PHP_EOL);
        print_r("--------------------------------------------------".PHP_EOL);
        print_r("".PHP_EOL);
        print_r("Generating users avatar".PHP_EOL);
        print_r("".PHP_EOL);
        print_r("--------------------------------------------------".PHP_EOL);
        print_r("".PHP_EOL);

        // Generate Users Avatar
        $users = Users::all()->toArray();
        foreach ($users as $user){
            //avatar url
            $first_name = urlencode($user['first_name']);
            $last_name = urlencode($user['last_name']);
            $full_name = $first_name .' '. $last_name;
            $url = 'https://ui-avatars.com/api/?background=rgb(108, 213, 203)&color=fff&font-size=0.30&bold=true&name=' . $full_name;
            $image = file_get_contents($url);
            $text = strtolower(str_replace(' ', '', $user['first_name'] . $user['last_name']).$user['id']);
            $name = $text . '.jpg';
            if ($image !== false) {
                $directory = './storage/app/public/media/image/';
                $file = $directory . $name;
                file_put_contents($file, $image);
            }
            $eachUser = Users::where('id',$user['id'])->first();
            $eachUser['avatar'] = $name;
            $eachUser->save();
            print_r("User ". $user['first_name'] .' '. $user['last_name'] ."'s avatar generated ".PHP_EOL);
        }

        print_r("".PHP_EOL);
        print_r("--------------------------------------------------".PHP_EOL);
        print_r("".PHP_EOL);
        print_r("Users avatar generated. Generating Customers avatar".PHP_EOL);
        print_r("".PHP_EOL);
        print_r("--------------------------------------------------".PHP_EOL);
        print_r("".PHP_EOL);

        // Generate Customers Avatar
        $customers = Customers::all()->toArray();
        foreach ($customers as $customer){
            //avatar url
            $first_name = urlencode($customer['first_name']);
            $last_name = urlencode($customer['last_name']);
            $full_name = $first_name .' '. $last_name;
            $url = 'https://ui-avatars.com/api/?background=rgb(108, 213, 203)&color=fff&font-size=0.30&bold=true&name=' . $full_name;
            $image = file_get_contents($url);
            $text = strtolower(str_replace(' ', '', $customer['first_name'] . $customer['last_name']).$customer['id']);
            $name = $text . '.jpg';
            if ($image !== false) {
                $directory = './storage/app/public/media/image/';
                $file = $directory . $name;
                file_put_contents($file, $image);
            }
            $eachCustomer = Customers::where('id',$customer['id'])->first();
            $eachCustomer['avatar'] = $name;
            $eachCustomer->save();
            print_r("Customer ". $customer['first_name'] .' '. $customer['last_name'] ."'s avatar generated ".PHP_EOL);
        }

        print_r("".PHP_EOL);
        print_r("--------------------------------------------------".PHP_EOL);
        print_r("".PHP_EOL);
        print_r("Customers avatar generated".PHP_EOL);
        print_r("".PHP_EOL);
        print_r("--------------------------------------------------".PHP_EOL);
        print_r("".PHP_EOL);
    }
}
