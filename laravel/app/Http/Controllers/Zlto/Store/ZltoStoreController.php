<?php

namespace App\Http\Controllers\Zlto\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Services\ZltoAuthService;

class ZltoStoreController extends Controller
{
    /************************************************************************
    *
    ************************************************************************* 
    * Display a listing of the resource.
    * All Stores.
    * Description
    * Retrieve all curated store listing.
    * Optional URI Flags
    * country_code
    * Choices: [ZA|NG|UK|US].
    * Default: ZA
    * eg. ?country_code=ZA
    * category
    * Category name
    * eg. ?category=Connectivity
    * Usage
    * ([?|&]uri_flag=[arg(s)|[True|False]])
    * Scope
    * store
    * @return \Illuminate\Http\Response
    */
    public function index(ZltoAuthService $auth_service)
    {
        //$auth_service->get_zlto_auth_token('lXDgkYpqtVtgo4yga14AXFnljxzA0HOU5N3373th','wQccNFo6ed1DwnKWX8mYGftAN6YMnnARTTVeTcKqVes31mZxBDTHg0xh1Wytya4CtLFjATU4t7V8D7OuVGQqeGY7cmsgOb0cZh8GTKDZntmc8So6ccJWJsruXG0wOxAb', 'store client earn');
        $auth_service->get_zlto_auth_token('zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX','hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v','store');
        $response_ = (new Client())->get('https://staging-api.zlto.co/store/stores', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       
       return response()
       ->json([
            'record'=>json_decode( $response_->getBody(), true)
        ]);
    }

    /**************************************************************************
    *
    **************************************************************************
    *Store Item Details.
    * Desciption
    * Retrieve all store item for a particular store.
    * The ids here in these objects are also referred to as item_group_ids later in the purchase endpoint.
    * Scope
    * store
    */
    public function get_store_item_details()
    {
        $response_ = (new Client())->get('https://api.zlto.co/store/items/{store_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));

    }

    /**************************************************************************
    *
    **************************************************************************
    *Purchase.
    * Description
    * Attempt to purchase an item
    * Scope
    * store
    * client
    */
    public function purchase_item()
    {
        $response_ = (new Client())->get('https://api.zlto.co/store/purchase/{item_group_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /**************************************************************************
    *
    **************************************************************************
    * Coupon Logs.
    * Description
    * Retrieve a user's coupon history.
    * Scope
    * store
    * client
    * Description
    * Ordered by more recent purchase first "timestamp_purchased"
    */
    public function get_coupon_logs()
    {
        $response_ = (new Client())->get('https://api.zlto.co/store/transaction/coupon/list/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /**************************************************************************
    *
    **************************************************************************
    *Transaction logs.
    * Description
    * Retrieve a user's transaction logs.
    * Scope
    * store
    * client
    */
    public function get_transaction_logs()
    {
        $response_ = (new Client())->get('https://api.zlto.co/store/transaction/list/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}