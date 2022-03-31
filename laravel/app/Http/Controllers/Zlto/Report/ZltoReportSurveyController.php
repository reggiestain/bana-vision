<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZltoReportSurveyController extends Controller
{
    /***************************************************************************
    *
    ************************************************************************** 
    * Display a listing of the resource.
    * All Surveys.
    * Description
    * Provides a summary of the Survey details, number of questionnairs, and number 
    * of people that has completed each survey
    * Scope
    * partner
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response_ = (new Client())->get('https://api.zlto.co/report/earn/surveys/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /**************************************************************************
    *
    **************************************************************************
    *Survey - Answer List.
    * Description
    * Provides a detailed list of user responses to survey questions
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
    * is_paginated - This will return a flatten list.
    * Default: True
    * eg. ?is_paginated=False
    * Scope
    * partner
    *
    *
    */
    public function get_answer_list()
    {
        $response_ = (new Client())->get('https://api.zlto.co/report/earn/survey/answers/{questionnaire_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));

    }

    /**************************************************************************
    *
    **************************************************************************
    *Survey - User's Answer to Survey.
    * Description
    * Retrieve a list of user answers to a survey.
    * Optional URI Flags
    * offset
    * Default: 0
    * eg. ?offset=ZA
    * limit
    * Default: 100
    * eg. ?limit=True
    * Scope
    * partner
    *
    *
    */
    public function get_users_answers_to_survey()
    {
        $response_ = (new Client())->get('https://api.zlto.co/report/earn/survey/answers/{questionnaire_id}/user/{client_uuid}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /**************************************************************************
    *
    **************************************************************************
    * Survey - Completed Users List.
    * Description
    * Provides a detailed list of users responses that has completed a survey.
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
    * is_paginated - This will return a flatten list.
    * Default: True
    * eg. ?is_paginated=False
    * Scope
    * partner
    *
    *
    */
    public function get_completed_users_list()
    {
        $response_ = (new Client())->get('https://api.zlto.co/report/earn/survey/users/completed/{questionnaire_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /**************************************************************************
    *
    **************************************************************************
    *A Survey Summary.
    * Description
    * Provides a summary of the Survey and its answers and unique users. Provides Questions 
    * and 1st Level detail of users' uuid that has started and completed the surveys
    * Scope
    * partner
    *
    *
    */
    public function get_survey_summary()
    {
            $response_ = (new Client())->get('https://api.zlto.co/report/earn/survey/{questionnaire_id}/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
    
}
