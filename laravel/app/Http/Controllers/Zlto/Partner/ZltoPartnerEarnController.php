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

class ZltoPartnerEarnController extends Controller
{
    /****************************************************************
    *
    *****************************************************************
    *
    * Earn - All Users Earn list.
    * Description
    * Retrieve all the self-initiated, microtask records that belongs to a user.
    * Scope
    * partner
    * earn
    */
    public function get_all_users_earn_list(ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','partner earn');
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/earn/tasks/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));

    }

    /****************************************************************
    *
    *****************************************************************
    *
    * Earn - Users' Earn list.
    * Description
    * Retrieve all the self-initiated, microtask records that belongs to a user.
    * Scope
    * partner
    * earn
    */
    public function get_users_earn_list(User $user,ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','partner earn');
        $zlto_my_uuid_id = $user->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/earn/tasks/'.$zlto_my_uuid_id.'/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

      
       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);

    }

    /****************************************************************
    *
    *****************************************************************
    *
    *   Earn - Verified Task*.
    * Description
    * Post a verified deed on behalf of user. Partners are able to post verified deeds, 
    * that are deemed completed are verified work from the organization.
    * Note: only available to verified partners
    * Scope
    * earn
    * partner
    */
    public function create_verified_task(User $user,ZltoAuthService $auth_service)
    {
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','partner earn');
        $zlto_my_uuid_id = $user->usable->zlto_my_uuid_id;
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token')
                ]
       ]); 
        $data=[
            "title"=> "Verified Task",
            "description"=> "Additional Details", //OPTIONAL
            "amount"=> 10
        ];

        $response = $client->post('https://staging-api.zlto.co/partner/earn/verified/'.$zlto_my_uuid_id.'/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return response()->json(['post1'=> $res_data]);

    }
}
