<?php

namespace App\Http\Controllers\Zlto\Earn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ZltoAuthService;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\User;



class ZltoEarnController extends Controller
{
    /****************************************************************************
    * LIST ALL USER MICROTASKS
    * user-microtasks-list
    *****************************************************************************
    * Description
    * Retrieve all the self-initiated, microtask records that belongs to logged in user.
    * Scope
    * earn
    * client
    * @return \Illuminate\Http\Response
    */
    public function index(User $user,ZltoAuthService $auth_service)
    {
        //$auth_service->get_zlto_auth_token('lXDgkYpqtVtgo4yga14AXFnljxzA0HOU5N3373th','wQccNFo6ed1DwnKWX8mYGftAN6YMnnARTTVeTcKqVes31mZxBDTHg0xh1Wytya4CtLFjATU4t7V8D7OuVGQqeGY7cmsgOb0cZh8GTKDZntmc8So6ccJWJsruXG0wOxAb', 'store client earn');
        //$auth_service->get_zlto_auth_token('zXUi1n5Yn7vh0hyRIXOeEaklDsXpvhd6Dh5Nekg5','m6rEUJw8HVd8U0XfGNu2dIO304KaJRXOifmYTu3ZsCCmkORUgNThljgWWDj2MgXQIm7StFhX21Q8azVlnD8R6Gz1C1lZdAknTQiXnE9R3E3MQuRTkRZ90SaHwlGVrm1v', 'client earn');
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v', 'earn client');
        //$auth_service->get_zlto_auth_token('S87FbhA3ZM4mnCa0mYamjudzzO9GFuKpbLHqKZsL','4PnpXBG6EZWhupY50bqYOAeQuCsnd5m5b23RgRLG9bdBqhQSv70ofRbyp5ntZmTbQ6LCCcHaQejoGskLHsH4O5QlovWxbkKT5lRLEh9LWZb6qrlZHvodI028rOewc3en',' earn client');
        //$zlto_my_uuid_id = $user->usable->zlto_my_uuid_id;

        $response_ = (new Client())->get('https://staging-api.zlto.co/earn/surveys/', [
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
    *****************************************************************************
    * Store a newly created resource in storage.
    * Create a new self-initiated activity.
    * Scope
    * earn
    * client
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $response_ = (new Client())->get('https://api.zlto.co/earn/create/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);
    }

    /*****************************************************************************
    *
    ***************************************************************************** 
    *
    * Description
    * Retrieve on record from all the list of self-initiated, microtask records.
    * Scope
    * earn
    * client
    *
    *
    */
    public function get_record()
    {
        $response_ = (new Client())->get('https://api.zlto.co/earn/task/{id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);
    }

    /***************************************************************************
    * DEED CATEGORIES
    * 
    ****************************************************************************
    * Description
    * Retrieve Primary Deed Categories.
    * Scope
    * earn
    *
    */
    public function get_categories(ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v', 'earn');
         $response_ = (new Client())->get('https://staging-api.zlto.co/earn/categories/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()
       ->json([
            'categories'=>json_decode( $response_->getBody(), true)
        ]);
    }
}