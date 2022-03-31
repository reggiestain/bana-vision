<?php

namespace App\Http\Controllers\Zlto\Earn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Services\ZltoAuthService;

class ZltoEarnMicrotaskController extends Controller
{
    /********************************************************************
    * LIST ALL MICROTASKS LISTED BY OWN PARTNER
    *  microtasks-list
    *********************************************************************
    * Microtask - All Microtasks.
    * Description
    * "microtasks": A list of micro tasks listed by your own partner.
    * "root_parent": Root partners exist as parents to other partners. 
    * When one of these parent partners list a microtask they are published to its child partners.
    * "others": List of other partners that published their microtasks publically.
    * Scope
    * earn
    * client
     * @return \Illuminate\Http\Response
     */
    public function index(ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v',' earn client');
        
        //$auth_service->get_zlto_auth_token('S87FbhA3ZM4mnCa0mYamjudzzO9GFuKpbLHqKZsL','4PnpXBG6EZWhupY50bqYOAeQuCsnd5m5b23RgRLG9bdBqhQSv70ofRbyp5ntZmTbQ6LCCcHaQejoGskLHsH4O5QlovWxbkKT5lRLEh9LWZb6qrlZHvodI028rOewc3en','client store earn');

        $response_ = (new Client())->get('https://staging-api.zlto.co/earn/microtasks/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);
    }

    /********************************************************************
    * 
    *********************************************************************
    * Store a newly created resource in storage.
    * Microtask - Submit record.
    * Description
    * "opportunity" ID is required to post with to reference the microtask the user selected to complete.
    * Note: This will automatically credit the user on submission.
    * Scope
    * earn
    * client
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ]
       ]); 
        $data=[
            "opt_in_code"=> 123 ,# Required, obtained after opting in first.
            "date_performed"=> "2019-01-01" ,# YYYY-MM-DD
            "image_after"=> "/images/...jpg",
            "location_coordinates"=> "-29.0000,31.9999",
            "description"=> "Addtional description"
        ];

        $response = $client->post('https://api.zlto.co/earn/microtasks/submit/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /*******************************************************************
    *
    ********************************************************************
    *
    * Microtask - Submit Unshaped record.
    * Description
    * "opportunity" ID is required to post with to reference the microtask the user selected to complete.
    * Here client apps may submit any json payload to add supplementary data regarding the microtask.
    * status
    * 1 - Pending
    * 2 - Approved
    * 3 - Decline
    * 4 - Flagged
    * Scope
    * earn
    * client
    */
    public function submit_unshaped_record()
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ]
       ]); 
        $data=[
            "opt_in_code"=> 123, # Required, obtained after opting in first.
            "unshaped_payload"=> "{details: details goes here}",
            "submission_no"=> 1,
            "status"=> 1 
        ];

        $response = $client->post('https://staging-api.zlto.co/earn/microtasks/unshaped/submit/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }
}