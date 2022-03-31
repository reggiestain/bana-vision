<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoListedOpportunityController extends Controller
{

    /**********************************************************************
    * 
    ***********************************************************************
    * Store a newly created resource in storage.
    * Description
    * Create a Listed Opportunity.
    * Scopes
    * partner
    * admin
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token');
                ]
            ]); 
        $data=[
            "title"=> "John Doe", # Required
            "category"=> "Business Idea", # Required
            "description"=> "...", # Required
            "campaign_pic"=> "blob=>//", # File . Required
            "amount"=> "...", # Required
            "opportunity_date", "YYYY-MM-DD eg. 2020-01-01" # Required
            "opportunity_end_date", "YYYY-MM-DD eg. 2020-01-31" # Required 
        ];

        $response = $client->post('https=>//staging-api.zlto.co/administrative/microtasks/create/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
        
    }

    /*******************************************************************
    * 
    ********************************************************************
    * Update the specified resource in storage.
    * Admin - Update Listed Opportunity.
    * Description
    * Update Listed Opportunity.
    * Scopes
    * partner
    * admin
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
            "title"=> "John Doe", # Required
            "category"=> "Business Idea", # Required
            "description"=> "...", # Required
            "campaign_pic"=> "blob=>//", # File . Optional
            "amount"=> "...", # Required
            "opportunity_date", "YYYY-MM-DD eg. 2020-01-01" # Required
            "opportunity_end_date", "YYYY-MM-DD eg. 2020-01-31" # Required
            "reference_name"=> 'John Doe' # Required
            "reference_contact_number"=> 'John Doe' # Required
            "id"=> 12 # Required 
        ];

        $response = $client->put('https://staging-api.zlto.co/administrative/microtasks/create/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid

    }
}

