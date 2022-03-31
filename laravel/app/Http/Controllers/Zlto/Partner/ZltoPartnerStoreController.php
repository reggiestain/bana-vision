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

class ZltoPartnerStoreController extends Controller
{
    /*********************************************************************
    *
    **********************************************************************
    * Store - Item purchased User List.
    * Description
    * Return a list of purchased items providing client details.
    * Scope
    * store
    * partner
    * 
    *  
    */
    public function get_store_item_purchased_list()
    {
        //ZltoAuthService $auth_service
//$auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','store');
        $response_ = (new Client())->get('https://api.zlto.co/partner/store/product/purchased/{item_group_id}', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /*********************************************************************
    *
    **********************************************************************
    * Store - Purchase.
    * Description
    * A facilitated purchase by the partner for the user.
    * Scope
    * store
    * partner
    * 
    *  
    */
    public function store_purchase()
    {
        $response_ = (new Client())->get('https://api.zlto.co/partner/store/purchase/{client_uuid}/{item_group_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /*********************************************************************
    *
    **********************************************************************
    * 
    * Store - Coupon Logs.
    * Optional URI Flags
    * offset
    * Default: 0
    * eg. ?offset=ZA
    * limit
    * Default: 100
    * eg. ?limit=True
    * daterange
    * Description: This will filter records by timestamp_purchase
    * Format: YYYY-MM-01+-+YYYY-MM-01
    * eg. ?daterange=2020-06-24+-+2020-07-26
    * profile_gender
    * Default: All
    * choices: [male|female|other|prefer not to answer]
    * eg. ?profile_gender=male
    * Scope
    * partner
    * store
    * Description
    * Partner retrieving a user's coupon history.
    * Ordered by more recent purchase first "timestamp_purchased"  
    */
    public function get_coupon_logs()
    {
        $response_ = (new Client())->get('https://api.zlto.co/partner/store/transaction/coupon/list/{client_uuid}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /*********************************************************************
    *
    **********************************************************************
    * 
    * Store - Users Transaction Logs.
    * Description
    * Retrieve all partner's user transaction logs.
    * Optional URI Flags
    * offset
    * Default: 0
    * eg. ?offset=ZA
    * limit
    * Default: 100
    * eg. ?limit=True
    * daterange
    * Description: This will filter records by timestamp_purchase
    * Format: YYYY-MM-01+-+YYYY-MM-01
    * eg. ?daterange=2020-06-24+-+2020-07-26
    * profile_gender
    * Default: All
    * choices: [male|female|other|prefer not to answer]
    * eg. ?profile_gender=male
    * Scope
    * partner
    * store
    * 
    *  
    */
    public function get_all_users_transactions_logs()
    {
        $response_ = (new Client())->get('https://api.zlto.co/partner/store/transaction/list/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /*********************************************************************
    *
    **********************************************************************
    * Store - Transaction Logs.
    * Description
    * Retrieve all the user's transaction logs.
    * Optional URI Flags
    * offset
    * Default: 0
    * eg. ?offset=ZA
    * limit
    * Default: 100
    * eg. ?limit=True
    * daterange
    * Description: This will filter records by timestamp_purchase
    * Format: YYYY-MM-01+-+YYYY-MM-01
    * eg. ?daterange=2020-06-24+-+2020-07-26
    * Scope
    * partner
    * store
    * 
    *  
    */
    public function get_users_transaction_logs(User $user,ZltoAuthService $auth_service)
    { 
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','partner store');
        $zlto_my_uuid_id = $user->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/store/transaction/list/'.$zlto_my_uuid_id.'/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);
    }
}