<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoReportImpactController extends Controller
{
    /************************************************************************
    * 
    ************************************************************************
    * Display a listing of the resource.
    * mpact stats.
    * Description
    * Impact Stats based on users that have purchased from this partner's; (partner and child), store(s).
    * "transaction_types" Explanation
    * C2P "Customer to Partner" transaction, usually a user may have spent their own zlto on a product item a partner put on their store.
    * P2C "Partner to Customer" transaction. This indicates a partner has transferred or issued a user with zlto for a earn activity, microtask, opportunity or survey.
    * "origins" Explanation
    * "Normal" - A rare transaction that signals, either manual zlto insert.
    * "Store" - Indicates a user spent zlto on a store item.
    * "WorkAsset" - Indicates earning zlto for completion of a microtask or self-initiated task.
    * "Survey" - Indicates a completion of a survey.
    * "Review" - A sub category under Earning type transactions. Indicates a reviews gaining zlto for completing an review evaluation.
    * "Loan Taken" - Experimental
    * "Loan Repayment" - Experimental
    * Optional URI Flags
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
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $response_ = (new Client())->get('https://api.zlto.co/report/partner/summary/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /*************************************************************************
    *
    *************************************************************************
    * Impact Stats - Item Purchased Overview.
    * Description
    * Impact Store item Stats based on products purchased from this partner's; (partner and child), store(s).
    * Optional URI Flags
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
    */
    public function get_items_purchased_overview()
    {
        
        $response_ = (new Client())->get('https://api.zlto.co/report/partner/items/summary/purchased/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}