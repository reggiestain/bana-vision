<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoPartnerSurveyController extends Controller
{
    /*****************************************************************
    * 
    ******************************************************************
    * Display a listing of the resource.
    *
    * Survey - All Surveys.
    * Description
    * Retrieve available surveys.
    * Scope
    * earn
    * partner
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        https=>//api.zlto.co/partner/earn/surveys/
        $response_ = (new Client())->get('https=>//api.zlto.co/client/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }


    /*****************************************************************
    * 
    ******************************************************************
    * Survey - Submit answer on user's behave.
    * Description
    * Submit a survey's answer.
    * Note=> This is the the endpoint for submitting survey answers.
    * Scope
    * earn
    * partner
    * 
    */
    public function user_submit_answer()
    {
        $client = new Client(
            [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token')
                ]
       ]); 
        $data=[
           "question"=> 0,
            "answer"=> "string",
            "answer_file"=> "http=>//example.com"
        ];

        $response = $client->post('https=>//api.zlto.co/partner/earn/survey/{client_uuid}', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /*****************************************************************
    * 
    ******************************************************************
    * Survey - All Nano courses Surveys.
    * Description
    * Retrieve available nano courses.
    * Scope
    * earn
    * partner
    * 
    */
    public function get_all_nano_courses_surveys()
    {
        
        $response_ = (new Client())->get('https=>//api.zlto.co/partner/earn/courses/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}