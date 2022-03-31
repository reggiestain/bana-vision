<?php

namespace App\Http\Controllers\Zlto\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Services\ZltoAuthService;
use App\User;

class ZltoPartnerClientController extends Controller
{
    /************************************************************************
    * 
    *********************************************************************** 
    * Display a listing of the resource.
    * Client - All users.
    * Description
    * Retrieve a list of all the users that signed up with a partner.
    * Scope
    * partner
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $response_ = (new Client())->get('https=>//api.zlto.co/partner/users/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /************************************************************************
    * 
    ***********************************************************************
    * Display the specified resource.
    * Client - Profile profile.
    * Description
    * Retrieve one user's profile that belongs to the partner.
    * Scope
    * partner
    * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','partner');
        //$auth_service->get_zlto_auth_token('S87FbhA3ZM4mnCa0mYamjudzzO9GFuKpbLHqKZsL','4PnpXBG6EZWhupY50bqYOAeQuCsnd5m5b23RgRLG9bdBqhQSv70ofRbyp5ntZmTbQ6LCCcHaQejoGskLHsH4O5QlovWxbkKT5lRLEh9LWZb6qrlZHvodI028rOewc3en','partner');
        $zlto_my_uuid_id = $user->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/user/'.$zlto_my_uuid_id.'/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()->json(["posts1"=>(json_decode( $response_->getBody(), true))]);
    }

    /************************************************************************
    * 
    ***********************************************************************
    * Update the specified resource in storage.
    * Client - Update Profile Details.
    * Description
    * Update user's profile that belongs to the partner.
    * Scope
    * partner
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
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

        $response = $client->post('https=>//api.zlto.co/partner/user/{client_uuid}/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /***********************************************************************
    *
    ***********************************************************************
    *
    * Client - Transfer user.
    * Description
    * This will move a user's acccount to another Partner.
    * Note=> This function is one directional. Sending Partner must have "Transfer users send" enabled,
    * and receiving partners must "Transfer recieve users" enabled to receive users.
    * Scope
    * partner
    */
    public function transfer_user()
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
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

        $response = $client->put('https=>//api.zlto.co/partner/user/email/{client_email}/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /***********************************************************************
    *
    ***********************************************************************
    *
    * Client - Update Profile Details by Email Address.
    * Description
    * Update user's profile that belongs to the partner.
    * Scope
    * partner
    */
    public function update_profile_details_by_email()
    {
       $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ]
       ]); 
        $data=[
                 'name'=>$name,
                 'email' =>$email  
              ];

        $response = $client->put('https=>//api.zlto.co/partner/user/email/{client_email}/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid

    }

    /**********************************************************************
    *
    ***********************************************************************
    * Client - Profile profile by Email Address.
    * Description
    * Retrieve one user's profile that belongs to the partner.
    * Scope
    * partner
    */
    public function get_profile_profile_by_email()
    {
        
        $response_ = (new Client())->get('https=>//api.zlto.co/partner/user/email/{client_email}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}