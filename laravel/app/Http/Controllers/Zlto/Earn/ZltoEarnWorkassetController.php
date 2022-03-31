<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoEarnWorkassetController extends Controller
{
    /*****************************************************************************
    * 
    ******************************************************************************
    * Store a newly created resource in storage.
    * Workasset - Opt-in/Opt-out to Opportunity.
    * Description
    * Opt-in or Opt-out into the Opportunity record.
    * Scope
    * earn
    * client
    * Body (multipart/form-data, application/json)
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
                 'opportunity'=> 500
              ];

        $response = $client->post('https://api.zlto.co/earn/microtasks/opt/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid

    }

    /****************************************************************************
    * 
    *****************************************************************************
    * Display the specified resource.
    * Workasset - Record Check.
    * Description
    * Retrieve one record by opportunity.
    * Scope
    * earn
    * client
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
         $response_ = (new Client())->get('https://api.zlto.co/earn/microtasks/check/{opportunity_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}