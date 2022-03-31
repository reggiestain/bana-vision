<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::group(['middlewareGroups' => ['web']],function(){
	Route::get('/',function(){
		return view('welcome');
	})->name('home');*/

	Route::get('/','HomeController@index' )->name('home');


	//*******************HELP**********************

    Route::get('/help',[
		'uses'=> 'HelpController@getHelpPage',
		'as' => 'getHelpPage'
		]);
   
	/*Route::post('/signup',[
		'uses'=> 'UserController@postSignUp',
		'as' => 'signup'
		]);
*/
	//***************SIGN IN********************

  /*  Route::post('/signin',[
		'uses'=> 'UserController@postSignIn',
		'as' => 'signin'
		]);
    Route::get('/logout',[
		'uses'=> 'UserController@getLogout',
		'as' => 'logout'
		]);*/

//*******************SEARCH RESULTS**********************

    Route::post('searchResults',[
		'uses'=> 'UserController@getSearchResults',
		'as' => 'searchResults'
		]);

//*******************DELETE PROFILE/COVER PICTURE**********************
    Route::post('deleteFile',[
		'uses'=> 'UserController@deleteFile',
		'as' => 'deleteFile'
		]);


//*******************RATE US**********************

    Route::post('/rateus',[
		'uses'=> 'SchoolController@createRating',
		'as' => 'rateus'
		]);

    

//*******************CREATE FEATURED STUDENT**********************

    Route::post('/create-featured-student',[
		'uses'=> 'StudentAwardController@createFeaturedStudent',
		'as' => 'createFeaturedStudent'
		]);

    

//*******************REQUEST A BOOK**********************

    Route::post('/request-book',[
		'uses'=> 'BookController@requestABook',
		'as' => 'requestBook'
		]);

//*******************STUDENT AWARD**********************

    Route::post('/create-student-award',[
		'uses'=> 'StudentAwardController@createStudentAward',
		'as' => 'createStudentAward'
		]);

//*******************CREATE NEEDS GRATITUDE**********************

    Route::post('/create-needs-gratitude',[
		'uses'=> 'NeedController@createNeedsGratitude',
		'as' => 'createNeedsGratitude'
		]);

//*******************CREATE NEEDS OVERVIEW**********************

    Route::post('/create-needs-overview',[
		'uses'=> 'NeedController@createNeedsOverview',
		'as' => 'createNeedsOverview'
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
    	'uses' => 'Auth\RegisterController@notifyPage',
    	'as' =>'payment-notify'
    ]);

//*******************CREATE REPLY**********************

    Route::post('/createReply',[
		'uses'=> 'PostController@createReply',
		'as' => 'createReply'
		]);

//*******************CREATE ATTENDANCE**********************

    Route::post('/takeAttendance',[
		'uses'=> 'AttendanceController@takeAttendance',
		'as' => 'takeAttendance'
		]);

//*******************CREATE SCHOOL CLASS**********************

    Route::post('/createSchoolClass',[
		'uses'=> 'SchoolController@createSchoolClass',
		'as' => 'createSchoolClass'
		]);

//*******************CREATE BOOK**********************

    Route::post('/createBook',[
    	'uses'=> 'BookController@createBook',
    	'as' => 'createBook'
    ]);


//*******************CREATE CHECKED OUT BOOK**********************

    Route::post('/createCheckedOutBook',[
		'uses'=> 'BookController@createCheckedOutBook',
		'as' => 'createCheckedOutBook'
		]);

//*******************CREATE LIBRARY BOOK**********************

    Route::post('/createLibraryBook',[
		'uses'=> 'BookController@createLibraryBook',
		'as' => 'createLibraryBook'
		]);

//*******************CREATE LOANED BOOK**********************

    Route::post('/createLoanedBook',[
		'uses'=> 'BookController@createLoanedBook',
		'as' => 'createLoanedBook'
		]);

    //*******************CREATE REQUESTED BOOK**********************

    Route::post('/createRequestedBook',[
		'uses'=> 'BookController@createRequestedBook',
		'as' => 'createRequestedBook'
		]);

//*******************CREATE STORAGE BOOK**********************

    Route::post('/createStorageBook',[
    	'uses'=> 'BookController@createStorageBook',
    	'as' => 'createStorageBook'
    ]);

//*******************CREATE CURRICULUMN**********************

    Route::post('/createCurriculumn',[
    	'uses'=> 'CurriculumnController@createCurriculumn',
    	'as' => 'createCurriculumn'
    ]);

//*******************EDIT CURRICULUMN**********************

    Route::post('/editCurriculumn',[
    	'uses'=> 'CurriculumnController@editCurriculumn',
    	'as' => 'editCurriculumn'
    ]);



//*******************CREATE SCHOOL STUDENT**********************

    Route::post('/createSchoolStudent',[
    	'uses'=> 'SchoolController@createSchoolStudent',
    	'as' => 'createSchoolStudent'
    ]);

//*******************CREATE GUARDIAN**********************

    Route::post('/createGuardian',[
    	'uses'=> 'SchoolController@createGuardian',
    	'as' => 'createGuardian'
    ]);

//*******************CREATE TEACHER**********************

    Route::post('/createStaff',[
    	'uses'=> 'TeacherController@createStaff',
    	'as' => 'createStaff'
    ]);

//*******************CREATE TEACHER PROFICIENCY**********************

    Route::post('/createTeacherProficiency',[
    	'uses'=> 'TeacherController@createTeacherProficiency',
    	'as' => 'createTeacherProficiency'
    ]);

//*******************ADD FACILITY**********************

    Route::post('/add-facility',[
    	'uses'=> 'FacilityController@addFacility',
    	'as' => 'addFacility',
    ]);


//*******************ADD ACTIVITY**********************

    Route::post('/add-activity',[
    	'uses'=> 'ActivityController@addActivity',
    	'as' => 'addActivity',
    ]);

//*******************GET RATING**********************

    Route::get('/getRating/{schoolId}',[
		'uses'=> 'SchoolController@getRating',
		'as' => 'getRating'
		]);

//*******************GET CURRICULUMN**********************

    Route::get('/get-curriculumn/{schoolId}',[
		'uses'=> 'SchoolController@getCurriculumn',
		'as' => 'getCurriculumn'
		]);

/*//*******************GET ANNOUNCEMENTS**********************

    Route::get('/announcements',[
		'uses'=> 'AnnouncementController@getAnnouncements',
		'as' => 'getAnnouncements'
		]);
*/
//*******************GET INFO CENTER**********************

    Route::get('/info-center/{type}',[
		'uses'=> 'AnnouncementController@getAnnouncements',
		'as' => 'getAnnouncements'
		]);

//*******************images**********************

    Route::get('/reply-picture/{userId}/{filename}',[
		'uses'=> 'PostController@getReplyPic',
		'as' => 'getReplyPic'
		]);

//*******************COMMENTS**********************

    Route::get('/comments/{post_id}/{post_type}',[
		'uses'=> 'PostController@getComments',
		'as' => 'getComments'
		]);

//*******************REPLIES**********************

    Route::get('/replies/{comment_id}',[
		'uses'=> 'PostController@getReplies',
		'as' => 'getReplies'
		]);
 

//*******************Video**********************

    Route::get('/video/{video_id}',[
		'uses'=> 'VideoController@getVideo',
		'as' => 'getVideo'
		]);

//*******************Profile images**********************

    Route::get('/profile-picture/{filename}/{setting_id?}','UserController@getProfilePic',function($setting_id = null){
    	return $setting_id;
    }
	)->name('getProfilePic');

//*******************images**********************

    Route::get('/cover-picture/{filename}/{setting_id?}','UserController@getCoverPic',function ($setting_id = null){
    	return $setting_id;
    })->name('getCoverPic');

//*******************images**********************

    Route::get('/post-picture/{slug}/{folder}/{filename}/{subfolder}/{category}',[
		'uses'=> 'PostController@getPostPic',
		'as' => 'getPostPic'
		]);

//*******************GET SCHOOL SUBFOLDER IMAGES**********************

    Route::get('/sub-picture/{filename}/{folder?}',[
		'uses'=> 'SchoolController@getSubfolderPic',
		'as' => 'getSubfolderPic'
		]);

//*******************images**********************

    Route::get('/event-picture/{filename}',[
		'uses'=> 'EventController@getEventPic',
		'as' => 'getEventPic'
		]);

//*******************images**********************

    Route::get('/student-project-picture/{filename}',[
		'uses'=> 'StudentProjectController@getProjectPic',
		'as' => 'getProjectPic'
		]);

//*******************student project filter auto suggest**********************

    Route::get('/student-project-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'StudentProjectController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************filter student projects**********************

    Route::get('/filter-student-project/{filter_type}/{filter_parameter}',[
		'uses'=> 'StudentProjectController@filterStudentProject',
		'as' => 'filterStudentProject'
		]);


//*******************company filter auto suggest**********************

    Route::get('/company-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'CompanyController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************company student projects**********************

    Route::get('/filter-company/{filter_type}/{filter_parameter}',[
		'uses'=> 'CompanyController@filterCompany',
		'as' => 'filterCompany'
		]);
//***
//*******************organization filter auto suggest**********************

    Route::get('/organization-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'OrganizationController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************organization student projects**********************

    Route::get('/filter-organization/{filter_type}/{filter_parameter}',[
		'uses'=> 'OrganizationController@filterOrganization',
		'as' => 'filterOrganization'
		]);
//***

//*******************student award filter auto suggest**********************

    Route::get('/student-award-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'StudentAwardController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************filter student award**********************

    Route::get('/filter-student-award/{filter_type}/{filter_parameter}',[
		'uses'=> 'StudentAwardController@filterStudentAward',
		'as' => 'filterStudentAward'
		]);

//*******************student featured filter auto suggest**********************

    Route::get('/student-featured-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'FeaturedStudentController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************filter student featured**********************

    Route::get('/filter-student-featured/{filter_type}/{filter_parameter}',[
		'uses'=> 'FeaturedStudentController@filterStudentFeatured',
		'as' => 'filterStudentFeatured'
		]);

//*******************NEEDS filter auto suggest**********************

    Route::get('/needs-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'NeedController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************filter NEEDS**********************

    Route::get('/filter-needs/{filter_type}/{filter_parameter}',[
		'uses'=> 'NeedController@filterNeeds',
		'as' => 'filterNeeds'
		]);


//*******************BURSARIES filter auto suggest**********************

    Route::get('/bursaries-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'BursariesController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************filter BURSARIES**********************

    Route::get('/filter-bursaries/{filter_type}/{filter_parameter}',[
		'uses'=> 'BursariesController@filterBursaries',
		'as' => 'filterNeeds'
		]);

//*******************EVENTS filter auto suggest**********************

    Route::get('/events-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'EventController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************EVENTS BURSARIES**********************

    Route::get('/filter-events/{filter_type}/{filter_parameter}',[
		'uses'=> 'EventController@filterEvents',
		'as' => 'filterEvents'
		]);

//*******************SCHOOLS filter auto suggest**********************

    Route::get('/schools-auto-suggest/{suggest_type}/{suggest_parameter}',[
		'uses'=> 'SchoolController@getFilterAutoSuggest',
		'as' => 'getFilterAutoSuggest'
		]);
//*******************SCHOOLS FILTER**********************

    Route::get('/filter-schools/{filter_type}/{filter_parameter}',[
		'uses'=> 'SchoolController@filterSchools',
		'as' => 'filterEvents'
		]);

Route::get('pdfview', 'SchoolController@pdfview')->name('pdfview');

//*******************set cover images**********************

    Route::post('/save-video',[
		'uses'=> 'VideoController@saveVideo',
		'as' => 'saveVideo'
		]);



//*******************set cover images**********************

    Route::post('/setImage',[
		'uses'=> 'UserController@setImage',
		'as' => 'setImage'
		]);


//*******************set cover images**********************

    Route::post('/setCoverPhoto',[
		'uses'=> 'UserController@setCoverPhoto',
		'as' => 'setCoverPhoto'
		]);

//*******************set profile images**********************

    Route::post('/setProfilePhoto',[
		'uses'=> 'UserController@setProfilePhoto',
		'as' => 'setProfilePhoto'
		]);


//*******************USER EDIT INFO**********************

    Route::post('/editInfo',[
		'uses'=> 'UserController@userEditInfo',
		'as' => 'editInfo'
		]);


   //*******************SET Messages seen**********************

    Route::post('setMessageSeen',[
		'uses'=> 'UserController@setMessageSeen',
		'as' => 'setMessageSeen'
		]);




    //*******************USER DELETE Messages**********************

    Route::get('deleteMessages/{messageId}',[
		'uses'=> 'UserController@deleteMessages',
		'as' => 'deleteMessages'
		]);

 //*******************USER SEND Messages**********************

    Route::post('/sendMessage',[
		'uses'=> 'UserController@createMessage',
		'as' => 'sendMessage'
		]);


//*******************FOLLOW USER ********************
	Route::get('/followUser',[
		'uses' => 'UserController@followUser',
		'as' =>'followUser'
		]);

    //*****************************************************************
	Route::get('/dashboard',[
		'uses' => 'PostController@getDashboard',
		'as' => 'dashboard',
		'middleware'=>'auth'
		]);
//*******************CREATE POSTS ********************
	Route::post('/createPost',[
         'uses'=>'PostController@createPost',
         'as'=>'createPost'
		]);

//*******************CREATE POSTS ********************
	Route::post('/createFeedPost',[
         'uses'=>'PostController@createFeedPost',
         'as'=>'createFeedPost'
		]);

//*******************CREATE BURSARIES PAGE********************
	Route::post('/createBursary',[
         'uses'=>'BursariesController@createBursary',
         'as'=>'createBursary'
		]);
//*******************CREATE NEED ********************
	Route::post('/createNeed',[
         'uses'=>'NeedController@createNeed',
         'as'=>'createNeed'
		]);
//*******************SIGNUP PAGE********************
	Route::get('/signupPage',[
		'uses' => 'UserController@getSignupPage',
		'as' => 'signupPage',
		//'middleware'=>'auth'
		]);


//*******************GENERAL STUDENT PROJECTS PAGE********************
	Route::get('/generalStudentProjectsPage',[
		'uses' => 'StudentProjectController@getGeneralStudentProjectsPage',
		'as' => 'generalStudentProjects',
		//'middleware'=>'auth'
		]);

//*******************GENERAL STUDENT PROJECTS PAGE********************
	Route::get('/locations/{filter_type}/{filter_param}',[
		'uses' => 'HomeController@getLocations',
		'as' => 'getLocations',
		//'middleware'=>'auth'
		]);




//*******************GENERAL STUDENT AWARDS PAGE********************
	Route::get('/generalStudentAwardsPage',[
		'uses' => 'StudentAwardController@getGeneralStudentAwardsPage',
		'as' => 'generalStudentAwards',
		//'middleware'=>'auth'
		]);



//*******************GENERAL FEATURED STUDENTS PAGE********************
	Route::get('/generalFeaturedStudentsPage',[
		'uses' => 'FeaturedStudentController@getGeneralFeaturedStudentsPage',
		'as' => 'generalFeaturedStudents',
		//'middleware'=>'auth'
		]);

// ******************SCHOOLS PAGE******************

	Route::get('schools/{province?}',[
		'uses' => 'SchoolController@getSchoolsPage',
		'as' => 'schoolsPage',
		//'middleware'=>'auth'
		]);

// ******************COMPANIES PAGE******************

	Route::get('companies',[
		'uses' => 'CompanyController@getCompaniesPage',
		'as' => 'companiesPage',
		//'middleware'=>'auth'
		]);

// ******************ORGANIZATIONS PAGE******************

	Route::get('organizations',[
		'uses' => 'OrganizationController@getOrganizationsPage',
		'as' => 'organizationsPage',
		//'middleware'=>'auth'
		]);

//*******************GENERAL NEEDS PAGE********************
	Route::get('/needs',[
		'uses' => 'NeedController@getGeneralNeedsPage',
		'as' => 'generalNeeds',
		//'middleware'=>'auth'
		]);

//*******************BANA ABOUT US PAGE********************
	Route::get('/about-us',[
		'uses' => 'HomeController@getAboutUsPage',
		'as' => 'getAboutUsPage',
		]);


//*******************CREATE EVENT PAGE********************
	Route::post('/createEvent',[
         'uses'=>'EventController@createEventsPage',
         'as'=>'createEvent'
		]);
//*******************EDIT EVENTS PAGE********************
	Route::post('/editEvent',[
		'uses' => 'EventController@editEvent',
		'as' =>'editEvent'
		]);

//*******************CREATE EVENTS COMMENTS PAGE********************
	Route::post('/createComment',[
		'uses' => 'EventController@createComment',
		'as' =>'createComment'
		]);

//*******************GET NUMBER OF POST INTERACTIONS********************
	Route::get('/interactions-count/{post_id}/{post_type}',[
		'uses' => 'PostController@getInteractionsCount',
		'as' =>'getInteractionsCount'
		]);


//*****************DELETE EVENT********************
	Route::get('deleteEvent/{eventIdNo}',[
         'uses'=>'EventController@deleteEvent',
         'as'=>'deleteEvent'
		]);

//*****************DELETE NEED********************
	Route::get('deleteNeed/{needIdNo}',[
         'uses'=>'NeedController@deleteNeed',
         'as'=>'deleteNeed'
		]);

//*****************DELETE ACTIVITY********************
	Route::get('deleteActivity/{activityIdNo}',[
         'uses'=>'ActivityController@deleteActivity',
         'as'=>'deleteActivity'
		]);

//*****************DELETE FACILITY********************
	Route::get('deleteFacility/{facilityIdNo}',[
         'uses'=>'FacilityController@deleteFacility',
         'as'=>'deleteFacility'
		]);

//*****************DELETE BURSARY********************
	Route::get('deleteBursary/{bursaryId}',[
         'uses'=>'BursariesController@deleteBursary',
         'as'=>'deleteBursary'
		]);

//*****************DELETE STUDENT AWARD********************
	Route::get('deleteStudentAward/{studentAwardId}',[
         'uses'=>'StudentAwardController@deleteStudentAward',
         'as'=>'deleteStudentAward'
		]);

//*****************DELETE FEATURED STUDENT********************
	Route::get('deleteFeaturedStudent/{featuredStudentId}',[
         'uses'=>'FeaturedStudentController@deleteFeaturedStudent',
         'as'=>'deleteFeaturedStudent'
		]);


//*****************DELETE STUDENT PROJECT********************
	Route::get('deleteStudentProject/{studentProjectId}',[
         'uses'=>'StudentProjectController@deleteStudentProject',
         'as'=>'deleteStudentProject'
		]);

/*//*****************DELETE COMMENT********************
	Route::get('deleteComment/{commentIdNo}',[
         'uses'=>'EventController@deleteComment',
         'as'=>'deleteComment'
		]);*/

Route::get('/demo', function () {
    return new App\Mail\UserWelcome();
});

//*****************DELETE COMMENT********************
	Route::get('deleteComment/{commentIdNo}',[
         'uses'=>'InteractionsController@deleteComment',
         'as'=>'deleteComment'
		]);


//*****************DELETE REPLY********************
	Route::get('deleteReply/{replyIdNo}',[
         'uses'=>'EventController@deleteReply',
         'as'=>'deleteReply'
		]);


//*******************GENERAL EVENTS PAGE********************

	Route::get('/events',[
		'uses' => 'EventController@getGeneralEventsPage',
		'as' => 'generalEvents',
		//'middleware'=>'auth'
		]);


//*******************GENERAL EXCESS PAGE********************
	Route::get('/generalExcessPage',[
		'uses' => 'ExcessController@getGeneralExcessPage',
		'as' => 'generalExcess',
		//'middleware'=>'auth'
		]);



//*******************GENERAL HELP RECEIVED OR GIVEN PAGE********************
	Route::get('/generalHelpReceivedOrGivenPage',[
		'uses' => 'HelpReceivedOrGivenController@getGeneralHelpReceivedOrGivenPage',
		'as' => 'generalHelpReceivedOrGiven',
		//'middleware'=>'auth'
		]);


//*******************GENERAL BURSARIES AVAILABLE PAGE********************
	Route::get('/bursaries',[
		'uses' => 'BursariesController@getGeneralBursariesAvailablePage',
		'as' => 'generalBursaries',
		//'middleware'=>'auth'
		]);





//*******************GENNERAL INTERNSHIPS AVAILABLE PAGE********************
	Route::get('/generalInternshipsAvailablePage',[
		'uses' => 'InternshipsAvailableController@getGeneralInternshipsAvailablePage',
		'as' => 'generalInternshipsAvailable',
		//'middleware'=>'auth'
		]);

/*//*******************SCHOOL PROFILE PAGE********************
	Route::get('SchoolProfilePage/{userId}',[
          'uses'=>'HomeController@getSchoolProfilePage',
          'as' => 'SchoolProfilePage',
          //'middleware' => 'auth'
		]);*/
	/*Route::get('/SchoolSchoolProfilePage',[
          'uses'=>'PostController@getSchoolSchoolProfilePage',
          'as' => 'SchoolSchoolProfilePage',
          'middleware' => 'auth'
		]);*/
//*******************DELETE POST PAGE********************
	Route::get('/delete-post/{post_id}',[
          'uses'=>'PostController@getDeletePost',
          'as' => 'post.delete',
          //'middleware' => 'auth'
		]);
//*******************EDIT POST PAGE********************
	Route::post('/edit',[
		'uses' => 'PostController@postEditPost',
		'as' =>'edit'
		]);
//*******************LIKE POST PAGE********************
	Route::post('/like',[
		'uses' => 'PostController@postLikePost',
		'as' =>'like'
		]);

	//*******************LIKE EVENTS PAGE********************
	Route::get('/createLike',[
		'uses' => 'EventController@createLike',
		'as' =>'createLike'
		]);
//*******************SHARE POST********************
	Route::get('/sharePost',[
		'uses' => 'PostController@sharePost',
		'as' =>'sharePost'
		]);

    //*******************CREATE STUDENTS PROJECT********************
	Route::post('/create-students-project',[
         'uses'=>'StudentProjectController@createStudentsProject',
         'as'=>'createStudentsProject'
		]);

	//*******************CREATE TIMETABLE********************
	Route::post('/createTimetable',[
         'uses'=>'SchoolController@createTimetable',
         'as'=>'createTimetable'
		]);

	//*******************CREATE EXPLANATION********************
	Route::post('/createExplanation',[
         'uses'=>'NotesController@createExplanation',
         'as'=>'createExplanation'
		]);

	
	//*******************SEARCH LIBRARY********************
	Route::post('/search-library',[
         'uses'=>'BookController@searchLibrary',
         'as'=>'searchLibrary'
		]);

	//*******************DEFAULT AUTH ROUTES********************

	Auth::routes();

	//*******************REGISTRATION ROUTES********************

	Route::group(['prefix' => 'register'], function(){
  
    	Route::get('/', ['as' => 'register', 'uses' => 'Auth\RegisterController@createStep1']);
   
    	Route::get('/step-1', 'Auth\RegisterController@createStep1')->name('get-step1');
		Route::post('/step-1', 'Auth\RegisterController@postCreateStep1')->name('post-step1');

		Route::get('/step-2', 'Auth\RegisterController@createStep2')->name('get-step2');
		Route::post('/step-2', 'Auth\RegisterController@postCreateStep2')->name('post-step2');

		Route::get('/step-3', 'Auth\RegisterController@createStep3')->name('get-step3');
		Route::post('/step-3', 'Auth\RegisterController@postCreateStep3')->name('post-step3');

		Route::get('/step-4', 'Auth\RegisterController@createStep4')->name('get-step4');
		Route::post('/step-4', 'Auth\RegisterController@postCreateStep4')->name('post-step4');

		Route::get('/step-picture', 'Auth\RegisterController@createStepPicture')->name('get-step-picture');
		Route::post('/step-picture', 'Auth\RegisterController@postCreateStepPicture')->name('post-step-picture');

		Route::get('/step-final', 'Auth\RegisterController@createStepFinal')->name('get-step-final');
		Route::post('/step-final', 'Auth\RegisterController@postCreateStepFinal')->name('post-step-final');

});





Route::get('/home', 'HomeController@index')->name('home');

$this->get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
 //*******************SCHOOL PROFILE PAGE********************
 Route::get('{user}', 'HomeController@getSchoolProfilePage')->name('SchoolProfilePage')->middleware('status');


//*******************USER DETAILS********************
Route::get('{user}/details', function (App\User $user) {
    return redirect()->route('SchoolProfilePage',$user->slug)->with('tab', 'details');
})->name('userDetails')->middleware('status');
//*******************USER SETTINGS********************
Route::get('{user}/settings', function (App\User $user) {
    return redirect()->route('SchoolProfilePage',$user->slug)->with('tab', 'settings');
})->name('userSettings')->middleware('status');




/**
*
* route group ensures user not redirected to school routes when 
* the request is not of type school
*
*
*/

Route::middleware(['party','status'])->group(function () {

 //*******************EVENTS PAGE********************

Route::get('{user}/events',[
		'uses' => 'EventController@getOurEventsPage',
		'as' => 'ourEventsPage',
		//'middleware'=>'auth'
		]);

//*******************STUDENT PROJECTS PAGE********************
	Route::get('{user}/student-projects',[
		'uses' => 'StudentProjectController@getStudentProjectsPage',
		'as' => 'studentProjects',
		]);

//*******************FEATURED STUDENTS PAGE********************
	Route::get('{user}/featured-students',[
		'uses' => 'FeaturedStudentController@getFeaturedStudentsPage',
		'as' => 'featuredStudents',
		//'middleware'=>'auth'
	]);
//*******************OUR NEEDS PAGE********************
	Route::get('{user}/needs',[
		'uses' => 'NeedController@getOurNeedsPage',
		'as' => 'ourNeeds',
		//'middleware'=>'auth'
	]);
//*******************EXCESS PAGE********************
	Route::get('{user}/excess',[
		'uses' => 'ExcessController@getOurExcessPage',
		'as' => 'ourExcess',
		//'middleware'=>'auth'
	]);
//*******************HELP RECEIVED OR GIVEN PAGE********************
	Route::get('{user}/help-received-or-given',[
		'uses' => 'HelpReceivedOrGivenController@getHelpReceivedOrGivenPage',
		'as' => 'helpReceivedOrGiven',
		//'middleware'=>'auth'
	]);
//*******************BURSARIES AVAILABLE PAGE********************
	Route::get('{user}/bursaries',[
		'uses' => 'BursariesController@getBursariesPage',
		'as' => 'getBursaries',
		//'middleware'=>'auth'
	]);

//*******************ADMIN PAGE********************
	Route::get('{user}/admin',[
		'uses' => 'SchoolController@getAdminPage',
		'as' => 'getAdminPage',
		'middleware'=>'auth'
	]);
//*******************INTERNSHIPS AVAILABLE PAGE********************
	Route::get('{user}/internships',[
		'uses' => 'InternshipsAvailableController@getInternshipsAvailablePage',
		'as' => 'internshipsAvailable',
		//'middleware'=>'auth'
	]);

//*******************MAKE TIMETABLE PAGE********************
	Route::get('{user}/admin/makeTimetable',[
		'uses' => 'SchoolController@getMakeTimetablePage',
		'as' => 'getMakeTimetablePage',
		'middleware'=>'auth'
	]);

//*******************CURRICULUMN PAGE********************
	Route::get('{user}/admin/curriculumn',[
		'uses' => 'CurriculumnController@getCurriculumn',
		'as' => 'getCurriculumn',
		'middleware'=>'auth'
		]);

//*******************BOOKS PAGE********************
	Route::get('{user}/admin/books',[
		'uses' => 'BookController@getBooks',
		'as' => 'getBooks',
		'middleware'=>'auth'
		]);

//*******************SCHOOL STUDENTS********************
	Route::get('{user}/admin/students/{grade}/{class}',[
		'uses' => 'SchoolController@getSchoolStudents',
		'as' => 'getSchoolStudents',
		'middleware'=>'auth'
		]);

//*******************DELETE CURRICULUMN**********************

    Route::get('{user}/deleteCurriculumn/{curriculumn_id}',[
    	'uses'=> 'CurriculumnController@deleteCurriculumn',
    	'as' => 'deleteCurriculumn'
    ]);

//*******************images**********************

    Route::get('{user}/school-picture/{school_student_id}',[
		'uses'=> 'SchoolController@getSchoolPictures',
		'as' => 'getSchoolPictures'
		]);
    
});

//*******************USER EDIT INFO**********************

    Route::get('{user}/delete',[
		'uses'=> 'UserController@deleteUser',
		'as' => 'deleteUser',
		'middleware'=>['auth','status']
		]);

//*******************USER GET RATINGS**********************

    Route::get('{user}/getRating',[
		'uses'=> 'UserController@getRatings',
		'as' => 'getRating',
		]);
//*******************USERS FEED**********************

    Route::get('{user}/feed',[
		'uses'=> 'HomeController@getFeed',
		'as' => 'getFeed',
		'middleware'=>['auth','isAuthorised']
		]);
//*******************USER GET Messages**********************

    Route::get('{user}/messages',[
		'uses'=> 'UserController@getMessages',
		'as' => 'messages',
		'middleware'=>['auth','status']
		]);
//*******************USER GET NOTES**********************

    Route::get('{user}/notes',[
		'uses'=> 'NotesController@getNotesPage',
		'as' => 'getNotes',
		'middleware'=>['auth','status','isAuthorised']
		]);
//*******************NOTIFICATIONS PAGE********************
	Route::get('{user}/notifications',[
          'uses'=>'HomeController@getNotifications',
          'as' => 'notifications',
          'middleware' => ['auth','status']
		]);

//*******************POST PAGE********************
	Route::get('{user}/post/{interaction_type}/{interacted_id}',[
          'uses'=>'PostController@getPost',
          'as' => 'getPost',
          'middleware' => ['auth','status']
		]);

//*******************STUDENT AWARDS PAGE********************
	Route::get('{user}/student-awards',[
		'uses' => 'StudentAwardController@getStudentAwardsPage',
		'as' => 'studentAwards',
		'middleware'=>'status'
		]);

//*******************LIBRARY PAGE********************
	Route::get('{user}/library',[
		'uses' => 'BookController@getLibraryPage',
		'as' => 'library',
		'middleware'=>['auth','status']
		]);



//*******************LIBRARY PAGE********************
	Route::get('{user}/library/search-results/{query_result}',[
		'uses' => 'BookController@librarySearchResults',
		'as' => 'librarySearchResults',
		'middleware'=>['auth','status']
		]);

/*Finally, when calling the Auth::routes method, you should pass the verify option to the method:

Auth::routes(['verify' => true]);*/

//*******************GENERAL SEARCH********************
	Route::get('{user}/search/{query}/{query_type}/{query_field}/{multiple_queries}',[
		'uses' => 'UserController@search',
		'as' => 'search',
		]);

