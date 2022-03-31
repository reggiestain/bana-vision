<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoPartnerController extends Controller
{
    /*******************************************************************
    * 
    ********************************************************************
    * Account Details.
    * Description
    * Retrieve the account details of the partner you have access to.
    * Scope
    * partner
    */
    public function get_partner_account_details()
    {
        $response_ = (new Client())->get('https://api.zlto.co/partner/profile/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /*******************************************************************
    * 
    ********************************************************************
    * Sign up.
    * Description
    * Authorized endpoint for partners to post new user information to signup to Zlto.
    * Scopes
    * partner
    */
    public function user_sign_up()
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token')
                ]
       ]); 
        $data=[
            "name"=> "John",
            "surname"=> "John",
            "email"=> "john@doe.com"
        ];

        $response = $client->post('https://api.zlto.co/partner/signup/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }
}



