<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoClientProfileController extends Controller
{
    /**************************************************************
    *
    *************************************************************** 
    * Display a listing of the resource.
    * Profile Details.
    * Description
    * Retrieve your profile details.
    * Scope
    * client
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $response_ = (new Client())->get('https://api.zlto.co/client/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /************************************************************
    *
    ************************************************************* 
    * Update the specified resource in storage.
    * Description
    * Retrieve your profile details.
    * Scope
    * client
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token')
                ]
       ]); 
        $data=[
            "name"=> "string",
            "surname"=> "string",
            "email"=> "string",
            "cell_number_new"=> -2147483648,
            "gender"=> "male",
            "age"=> -2147483648,
            "location_coordinates"=> "string",
            "location_country"=> "string",
            "location_province"=> "string",
            "location_area"=> "string",
            "about_me"=> "string"
        ];

        $response = $client->post('https://staging-api.zlto.co/client/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }
}