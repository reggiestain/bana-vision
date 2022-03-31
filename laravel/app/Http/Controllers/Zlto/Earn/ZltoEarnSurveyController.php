<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoEarnSurveyController extends Controller
{
    /****************************************************************************
    * 
    *****************************************************************************
    * Display a listing of the resource.
    * Survey - All Surveys.
    * Description
    * Retrieve available surveys.
    * Scope
    * earn
    * client
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $response_ = (new Client())->get('https://api.zlto.co/earn/surveys/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /***************************************************************************
    *
    **************************************************************************** 
    * Store a newly created resource in storage.
    * Survey - Submit answer.
    * Description
    * Submit a survey's answer.
    * Note: This is the the endpoint for submitting survey answers.
    * Survey Type (questionnaire_type == 4)
    * iteration
    * Default: 1
    * eg. ?iteration=1
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
            "question"=> 375,
            "answer"=> "my answer",
            "answer_file"=> dataURItoBlob(image)  
        ];

        $response = $client->post('https://api.zlto.co/earn/survey/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }

    /***************************************************************************
    *
    ****************************************************************************
    *
    * Survey - Survey Summary.
    * Description
    * Retrieve a surveys details, survey questions and progress.
    * Scope
    * earn
    * client
    */
    public function get_survey_summary()
    {
        $response_ = (new Client())->get('https://api.zlto.co/earn/survey/{id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));

    }
}