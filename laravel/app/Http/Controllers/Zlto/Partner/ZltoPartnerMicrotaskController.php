<?php

namespace App\Http\Controllers\Zlto\Partner;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Services\ZltoAuthService;

use Illuminate\Http\Request;

class ZltoPartnerMicrotaskController extends Controller
{
    /***************************************************************************
    * 
    **************************************************************************
    * Display a listing of the resource.
    * Microtask - All Microtasks.
    * Description
    * "microtasks"=> A list of micro tasks listed by your own partner.
    * Scope
    * earn
    * partner
    * @return \Illuminate\Http\Response
    */
    public function index(ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','partner earn');
        //$auth_service->get_zlto_auth_token('S87FbhA3ZM4mnCa0mYamjudzzO9GFuKpbLHqKZsL','4PnpXBG6EZWhupY50bqYOAeQuCsnd5m5b23RgRLG9bdBqhQSv70ofRbyp5ntZmTbQ6LCCcHaQejoGskLHsH4O5QlovWxbkKT5lRLEh9LWZb6qrlZHvodI028rOewc3en',' earn client');
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/earn/microtasks/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);
    }


    /****************************************************************************
    * 
    ***************************************************************************
    * Store a newly created resource in storage.
    * Microtask - Submit task.
    * Description
    * Partner submitting Proof of work on behalf of user. "opportunity" ID is 
    * required to post with to reference the microtask the user selected to complete.
    * Scope
    * earn
    * partner
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token')
                ]
       ]); 
        $data=[
             "opportunity"=> 123,
            "date_performed"=> "2019-01-01", # YYYY-MM-DD
            "image_after"=> "/images/...jpg",
            "location_coordinates"=> "-29.0000,31.9999",
            "description"=> "Addtional description"
        ];

        $response = $client->post('https=>//api.zlto.co/partner/earn/microtasks/create/{client_uuid}/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /************************************************************************
    *
    *************************************************************************
    * 
    * Microtask - Credit Record.
    * Description
    * Return / Update the opt-in record .
    * Scope
    * earn
    * partner
    *  
    */
    public function create_microtask_credit()
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token')
                ]
       ]); 
        $data=[
            'opportunity_id'=> 1,
            'client_uuid'=> '0023-..'
        ];

        $response = $client->post('https://api.zlto.co/partner/earn/microtasks/credit', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /************************************************************************
    *
    *************************************************************************
    * Microtask - Task's User List.
    * Description
    * Partner requesting list users belonging to a microtask.
    * Scope
    * earn
    * partner
    * 
    *  
    */
    public function get_tasks_users_list()
    {
        $response_ = (new Client())->get('https=>//api.zlto.co/partner/earn/microtasks/users/{opportunity_id}', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}