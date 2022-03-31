<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth::routes();
 // Route::apiResource('{user}/usable/','UsableController');
/************************************IMPORTANT************************************
*this route must always be at the top
*/
  Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::post('/notify',[
	'uses'=> 'App\Http\Controllers\Auth\RegisterController@notify',
	'as' => 'notify'
	]);

Route::get('/verify-user/{code}', 'App\Http\Controllers\Auth\RegisterController@activateUser')->name('activate.user');




//*******************RATE US**********************

    Route::post('/rateus',[
    'uses'=> 'App\Http\Controllers\SchoolController@createRating',
    'as' => 'rateus'
    ]);



//*********************PAYMENT SUCCESFUL*******************************
    Route::get('payment-succesful', [function() {
         return view('auth.register-payment-return');
        }])->name('payment-succesful');

//*********************PAYMENT CANCELLED*******************************
    Route::get('payment-cancelled', [function() {
         return view('auth.register-payment-cancelled');
        }])->name('payment-cancelled');

//*********************PAYMENT CANCELLED*******************************
    Route::get('/payment-notify', [
      'uses' => 'App\Http\Controllers\Auth\RegisterController@notifyPage',
      'as' =>'payment-notify'
    ]);



//*******************Profile images**********************

    Route::get('/profile-picture/{filename}/{setting_id?}','App\Http\Controllers\ImageController@getProfilePic',function($setting_id = null){
      return $setting_id;
    }
  )->name('getProfilePic');

//*******************images**********************

    Route::get('/cover-picture/{filename}/{setting_id?}','App\Http\Controllers\UserController@getCoverPic',function ($setting_id = null){
      return $setting_id;
    })->name('getCoverPic');

//*******************images**********************

    Route::get('/post-picture/{slug}/{folder}/{filename}/{subfolder}/{category}',[
    'uses'=> 'App\Http\Controllers\ImageController@getPostPic',
    'as' => 'getPostPic'
    ]);

//*******************GET SCHOOL SUBFOLDER IMAGES**********************

    Route::get('/sub-picture/{filename}/{folder?}',[
    'uses'=> 'App\Http\Controllers\SchoolController@getSubfolderPic',
    'as' => 'getSubfolderPic'
    ]);

//*******************images**********************

    Route::get('/event-picture/{filename}',[
    'uses'=> 'App\Http\Controllers\EventController@getEventPic',
    'as' => 'getEventPic'
    ]);






//*******************BURSARIES filter auto suggest**********************

    Route::get('/bursaries-auto-suggest/{suggest_type}/{suggest_parameter}',[
    'uses'=> 'App\Http\Controllers\BursariesController@getFilterAutoSuggest',
    'as' => 'getFilterAutoSuggest'
    ]);
//*******************filter BURSARIES**********************

    Route::get('/filter-bursaries/{filter_type}/{filter_parameter}',[
    'uses'=> 'App\Http\Controllers\BursariesController@filterBursaries',
    'as' => 'filterNeeds'
    ]);


Route::get('pdfview', 'SchoolController@pdfview')->name('pdfview');




//*******************set cover images**********************

    Route::post('/setImage',[
    'uses'=> 'App\Http\Controllers\UserController@setImage',
    'as' => 'setImage'
    ]);


//*******************set cover images**********************

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\UserController@setCoverPhoto',
    'as' => 'setCoverPhoto'
    ]);

//*******************set profile images**********************

    Route::post('/setProfilePhoto',[
    'uses'=> 'App\Http\Controllers\UserController@setProfilePhoto',
    'as' => 'setProfilePhoto'
    ]);


    //*****************************************************************
  Route::get('/dashboard',[
    'uses' => 'App\Http\Controllers\PostController@getDashboard',
    'as' => 'dashboard',
    'middleware'=>'auth'
    ]);

//*******************SIGNUP PAGE********************
  Route::get('/signupPage',[
    'uses' => 'App\Http\Controllers\UserController@getSignupPage',
    'as' => 'signupPage',
    
    ]);



//******************* STUDENT PROJECTS PAGE********************
  Route::get('/locations/{filter_type}/{filter_param}',[
    'uses' => 'App\Http\Controllers\HomeController@getLocations',
    'as' => 'getLocations',
    
    ]);

  Route::apiResource('schools','App\Http\Controllers\SchoolController');
    Route::apiResource('companies','App\Http\Controllers\CompanyController');
  Route::apiResource('organizations','App\Http\Controllers\OrganizationController');

//*******************BANA ABOUT US PAGE********************
  Route::get('/about-us',[
    'uses' => 'App\Http\Controllers\HomeController@getAboutUsPage',
    'as' => 'getAboutUsPage',
    ]);

//*******************GET NUMBER OF POST INTERACTIONS********************
  Route::get('/interactions-count/{post_id}/{post_type}',[
    'uses' => 'App\Http\Controllers\PostController@getInteractionsCount',
    'as' =>'getInteractionsCount'
    ]);


Route::get('/demo', function () {
    return new App\Mail\UserWelcome();
});


  //*******************DEFAULT AUTH ROUTES********************

 // Auth::routes();

  //*******************REGISTRATION ROUTES********************

  Route::group(['prefix' => 'register'], function(){
  
     // Route::get('/', ['as' => 'register', 'uses' => 'App\Http\Controllers\Auth\RegisterController@createStep1']);
   
      Route::get('/step-1', 'App\Http\Controllers\Auth\RegisterController@createStep1')->name('get-step1');
    Route::post('/step-1', 'App\Http\Controllers\Auth\RegisterController@postCreateStep1')->name('post-step1');

    Route::get('/step-2', 'App\Http\Controllers\Auth\RegisterController@createStep2')->name('get-step2');
    Route::post('/step-2', 'App\Http\Controllers\Auth\RegisterController@postCreateStep2')->name('post-step2');

    Route::get('/step-3', 'App\Http\Controllers\Auth\RegisterController@createStep3')->name('get-step3');
    Route::post('/step-3', 'Auth\RegisterController@postCreateStep3')->name('post-step3');

    Route::get('/step-4', 'App\Http\Controllers\Auth\RegisterController@createStep4')->name('get-step4');
    Route::post('/step-4', 'App\Http\Controllers\Auth\RegisterController@postCreateStep4')->name('post-step4');

    Route::get('/step-picture', 'App\Http\Controllers\Auth\RegisterController@createStepPicture')->name('get-step-picture');
    Route::post('/step-picture', 'App\Http\Controllers\Auth\RegisterController@postCreateStepPicture')->name('post-step-picture');

    Route::get('/step-final', 'App\Http\Controllers\Auth\RegisterController@createStepFinal')->name('get-step-final');
    Route::post('/step-final', 'App\Http\Controllers\Auth\RegisterController@postCreateStepFinal')->name('post-step-final');

});





Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/verify-user/{code}', 'App\Http\Controllers\Auth\RegisterController@activateUser')->name('activate.user');
 //*******************SCHOOL PROFILE PAGE********************
 Route::get('{user}/school', 'App\Http\Controllers\SchoolController@show')->middleware('status');


//*******************USER DETAILS********************
Route::get('{user}/details', function (App\User $user) {
    return redirect()->route('App\Http\Controllers\SchoolProfilePage',$user->slug)->with('tab', 'details');
})->name('userDetails')->middleware('status');
//*******************USER SETTINGS********************
Route::get('{user}/settings', function (App\User $user) {
    return redirect()->route('App\Http\Controllers\SchoolProfilePage',$user->slug)->with('tab', 'settings');
})->name('userSettings')->middleware('status');




/**
*
* route group ensures user not redirected to school routes when 
* the request is not of type school
*
*
*/

Route::group(['middleware'=>[/*'party','status'*/],'prefix'=>'/{user}'],function () 
{
    Route::apiResource('events','App\Http\Controllers\EventController');
    Route::apiResource('needs','App\Http\Controllers\NeedController');
    Route::apiResource('bursaries','App\Http\Controllers\BursaryController');
    Route::apiResource('needs-gratitudes','App\Http\Controllers\NeedsGratitudeController');
    Route::apiResource('needs-overviews','App\Http\Controllers\NeedsOverviewController');
    Route::apiResource('student-projects','App\Http\Controllers\StudentProjectController');
    Route::apiResource('featured-students','App\Http\Controllers\FeaturedStudentController');
    Route::apiResource('student-awards','App\Http\Controllers\StudentAwardController');
    Route::apiResource('facilities','App\Http\Controllers\FacilityController');
    Route::apiResource('activities','App\Http\Controllers\ActivityController');

    
    //*******************ZLTO**********************

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\ZltoController@index',
        'as' => 'zlto'
    ]);

    //Zlto\Administrative\ZltoListedOpportunityController  //store,update
    //Zlto\Client\ZltoClientProfileController //index,update
    //Zlto\Earn\ZltoEarncontroller  //index,store,,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoController@get_record',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/deed/categories',[
        'uses'=> 'App\Http\Controllers\Zlto\Earn\ZltoEarnController@get_categories',
        'as' => 'zlto'
    ]);
    //**************************************LIST ALL USER MICROTASKS ***********************************************
    Route::get('/zlto/earn/user-microtasks-list',[
        'uses'=> 'App\Http\Controllers\Zlto\Earn\ZltoEarnController@index',
        'as' => 'zlto'
    ]);

    //**************************************LIST ALL MICROTASKS ***********************************************
    Route::get('/zlto/earn/microtasks-list',[
        'uses'=> 'App\Http\Controllers\Zlto\Earn\ZltoEarnMicrotaskController@index',
        'as' => 'zlto'
    ]);

    //Zlto\Earn\ZltoEarnMicrotaskController   //index,store,
    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoEarnMicrotaskController@submit_unshaped_record',
    'as' => 'setCoverPhoto'
    ]);
    ########################################
    //Zlto\Earn\ZltoEarnSurveyController  //,store,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\ZltoEarnSurveyController@index',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoEarnSurveyController@get_survey_summary',
        'as' => 'zlto'
    ]);

    //Zlto\Earn\ZltoEarnWorkassetController   //store,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoEarnWorkassetController@show',
        'as' => 'zlto'
    ]);

    //Zlto\Partner\ZltoPartnerClientController    //index,show,update,,,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerClientController@get_profile_profile_by_email',
        'as' => 'zlto'
    ]);

    /*Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerClientController@get_profile_profile_by_email',
        'as' => 'zlto'
    ]);*/

    ####################dont use this only for partner
    Route::get('/zlto/get-profile-profile',[
        'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerClientController@show',
        'as' => 'zlto'
    ]);

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerClientController@transfer_user',
    'as' => 'setCoverPhoto'
    ]);

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerClientController@update_profile_details_by_email',
    'as' => 'setCoverPhoto'
    ]);
    #####################################3
    //Zlto\Partner\ZltoPartnerController    //,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerController@get_partner_account_details',
        'as' => 'zlto'
    ]);

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerController@user_sign_up',
    'as' => 'setCoverPhoto'
    ]);
    #######################################
    //Zlto\Partner\ZltoPartnerEarnController      //,,
    Route::get('/zlto/partner/all-users-earn-list',[
        'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerEarnController@get_all_users_earn_list',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/partner/user-earn-list',[
        'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerEarnController@get_users_earn_list',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/partner/create-verified-task',[ //must change method from get to post immediately
    'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerEarnController@create_verified_task',
    'as' => 'setCoverPhoto'
    ]);
    ####################################

    //Zlto\Partner\ZltoPartnerMicrotaskController //index,store,,
    Route::get('/zlto/partner/partner-microtasks-list',[
        'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerMicrotaskController@index',
        'as' => 'zlto'
    ]);
    //Zlto\Partner\ZltoPartnerMicrotaskController //index,store,,
    Route::get('/zlto/get-tasks-users-list',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoMicrotasksController@get_tasks_users_list',
        'as' => 'zlto'
    ]);

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerMicrotasksController@create_microtask_credit',
    'as' => 'setCoverPhoto'
    ]);
    ###################################
    //Zlto\Partner\ZltoPartnerStoreController     //,store_purchase
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerStoreController@get_store_item_purchased_list',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerStoreController@get_coupon_logs',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/partner/all-users-transaction-logs',[
        'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerStoreController@get_all_users_transactions_logs',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/partner/user-transaction-logs',[
        'uses'=> 'App\Http\Controllers\Zlto\Partner\ZltoPartnerStoreController@get_users_transaction_logs',
        'as' => 'zlto'
    ]);
    
    //Zlto\Partner\ZltoPartnerSurveyController    //,index,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerSurveyController@get_all_nano_courses_surveys',
        'as' => 'zlto'
    ]);

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoPartnerSurveyController@user_submit_answer',
    'as' => 'setCoverPhoto'
    ]);
    ########################
    //Zlto\Report\ZltoReportImpactController      //index,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoReportImpactController@get_items_purchased_overview',
        'as' => 'zlto'
    ]);
    //Zlto\Report\ZltoReportSurveyController      //index,,,,
    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoReportSurveyController@get_answer_list',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoReportSurveyController@get_users_answers_to_survey',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoReportSurveyController@get_completed_users_list',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoReportSurveyController@get_survey_summary',
        'as' => 'zlto'
    ]);


   // Zlto\Store\ZltoStoreController              //index,,,,
    Route::get('/zlto/stores',[
        'uses'=> 'App\Http\Controllers\Zlto\Store\ZltoStoreController@index',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoStoreController@get_store_item_details',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoStoreController@get_coupon_logs',
        'as' => 'zlto'
    ]);

    Route::get('/zlto/',[
        'uses'=> 'App\Http\Controllers\Zlto\ZltoStoreController@get_transaction_logs',
        'as' => 'zlto'
    ]);

    Route::post('/setCoverPhoto',[
    'uses'=> 'App\Http\Controllers\Zlto\ZltoStoreController@purchase_item',
    'as' => 'setCoverPhoto'
    ]);
    ############################################3

    //*******************images**********************

    Route::get('/school-picture/{school_student_id}',[
        'uses'=> 'App\Http\Controllers\SchoolController@getSchoolPictures',
        'as' => 'getSchoolPictures'
    ]);



    //*******************USER GET RATINGS**********************

    Route::get('/getRating',[
        'uses'=> 'App\Http\Controllers\UserController@getRatings',
        'as' => 'getRating',
    ]);
    //*******************USERS FEED**********************

    Route::get('/feed',[
        'uses'=> 'App\Http\Controllers\HomeController@getFeed',
        'as' => 'getFeed',
        //'middleware'=>['auth:sanctum','isAuthorised']
         //'middleware'=>['auth:sanctum','isAuthorised']
    ]);
    //*******************USER GET Messages**********************

    Route::get('/messages',[
        'uses'=> 'App\Http\Controllers\UserController@getMessages',
        'as' => 'messages',
    ]);
    //*******************USER GET NOTES**********************

    Route::get('/notes',[
        'uses'=> 'App\Http\Controllers\NotesController@getNotesPage',
        'as' => 'getNotes',
        'middleware'=>['isAuthorised']
    ]);
    //*******************NOTIFICATIONS PAGE********************
    Route::get('/notifications',[
      'uses'=>'App\Http\Controllers\HomeController@getNotifications',
      'as' => 'notifications',
    ]);

    //*******************POST PAGE********************
    Route::get('/post/{interaction_type}/{interacted_id}',[
      'uses'=>'App\Http\Controllers\PostController@getPost',
      'as' => 'getPost',
    ]);


    //*******************LIBRARY PAGE********************
    Route::get('/library',[
        'uses' => 'App\Http\Controllers\BookController@getLibraryPage',
        'as' => 'library',
    ]);

    //*******************LIBRARY PAGE********************
    Route::get('/library/search-results/{query_result}',[
        'uses' => 'App\Http\Controllers\BookController@librarySearchResults',
        'as' => 'librarySearchResults',
    ]);

    //******************* SEARCH********************
    Route::get('/usable',[ //******change to use format below
        'uses' => 'App\Http\Controllers\UsableController@show',
        
    ]);

    //******************* SEARCH********************
    Route::get('/',[ //******change to use format below
        'uses' => 'App\Http\Controllers\UserController@show',
        'as' => 'user',
    ]);

});

//******************* SEARCH ********************
Route::get('/search/{query}/{query_type?}',[
    'uses' => 'App\Http\Controllers\SearchController@search',
    'as' => 'search',
]);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])
        ->name('verification.send');

    Route::apiResources([
        'posts' => PostController::class,
    ]);
});

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');



