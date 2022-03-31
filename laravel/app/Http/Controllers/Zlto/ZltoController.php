<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\User;

class ZltoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user,Request $request)
    {
        $this->zlto();
        $this->zlto_get_stores();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**********************************************************************************************
    * ZLTO GET OAUTH TOKEN
    ***********************************************************************************************
    *
    *
    */
    public function zlto($client_id,$client_secret)
    {
        $client = new Client(); 
        $data=[
                    'grant_type' => 'client_credentials',
                    //'client_id' => 'zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX',//$_ENV['ZLTO_CLIENT_ID'], // get id from the env file
                    //'client_secret' =>'hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v' ,//$_ENV["ZLTO_CLIENT_SECRET"], // get secret from the env file
                    /*'client_id'=> 'lXDgkYpqtVtgo4yga14AXFnljxzA0HOU5N3373th',
                    'client_secret'=> 'wQccNFo6ed1DwnKWX8mYGftAN6YMnnARTTVeTcKqVes31mZxBDTHg0xh1Wytya4CtLFjATU4t7V8D7OuVGQqeGY7cmsgOb0cZh8GTKDZntmc8So6ccJWJsruXG0wOxAb',*/
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                    'redirect_uri' => 'https://bana.vision',
                    "scope" => "partner store earn client"
                ];

        $response = $client->post('https://api.zlto.co/oauth/token/', ['json'=> $data] );






            $res_data = json_decode($response->getBody(), true);
            //dd($res_data['access_token']);
            session(['access_token'=>$res_data['access_token']]);
            //dd(session('access_token'));
            $token = $res_data['access_token'];

            return $token;

    }

    /***********************************************************************************************
    * ZLTO USER SIGNUP
    ************************************************************************************************
    * 
    * 
    * 
    */
    public function zlto_user_sign_up($token,$name,$email)
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

        $response = $client->post('https://staging-api.zlto.co/partner/signup/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /********************************************************************
    * GET USER ZLTO PROFILE DETAILS
    *********************************************************************
    *Retrieve one user's profile that belongs to the partner.
    *
    *
    */
    public function zlto_get_user_profile()
    {
        $zlto_my_uuid_id = Auth::user()->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/user/'.$zlto_my_uuid_id, [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /********************************************************************
    * GET BANA ZLTO USERS
    *********************************************************************
    *Retrieve one user's profile that belongs to the partner.
    *
    *
    */
    public function zlto_get_users()
    {
        $zlto_my_uuid_id = Auth::user()->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://api.zlto.co/partner/users/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /********************************************************************
    * GET ZLTO stores
    *********************************************************************
    *Retrieve one user's profile that belongs to the partner.
    *
    *
    */
    public function zlto_get_stores()
    {
        $response_ = (new Client())->get('https://api.zlto.co/store/stores', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /********************************************************************
    * GET ZLTO SURVEYS
    *********************************************************************
    * Provides a summary of the Survey details, number of questionnairs, and number of people that has completed each survey
    *
    *
    */
    public function zlto_get_surveys()
    {
        $response_ = (new Client())->get('https://api.zlto.co/report/earn/surveys/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /********************************************************************
    * GET ZLTO EARN CATEGORIES
    *********************************************************************
    * Retrieve Primary Deed Categories.
    *
    *
    */
    public function zlto_get_earn_categories()
    {
        $response_ = (new Client())->get('https://api.zlto.co/earn/categories/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /********************************************************************
    * GET ZLTO EARN MICROTASKS
    *********************************************************************
    * "microtasks": A list of micro tasks listed by your own partner.
    * "root_parent": Root partners exist as parents to other partners. When one of these parent partners list a microtask they are published to its child partners.
    * "others": List of other partners that published their microtasks publically.
    *
    *
    */
    public function zlto_get_earn_microtasks()
    {
        $response_ = (new Client())->get('https://api.zlto.co/earn/microtasks/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}
//Retrieve one user's profile that belongs to the partner.
//https://api.zlto.co/partner/user/{client_uuid}/

//Retrieve a list of all the users that signed up with a partner.
//https://api.zlto.co/partner/users/