<?php
namespace App\Http\Controllers\Auth;
use App\Notifications\UserRegisteredSuccessfully;
use App\Notifications\UpdateProfilePicture;
use App\Helpers\Images;
use App\User;
use App\Student;
use App\School;
use App\SchoolStudent;
use App\Event;
use App\Like;
use App\Comment;
use App\Image;
use App\Message;
use App\Pricing;
use App\Payment;
use App\Company;
use App\AccountsTable;
use App\Organization;
use Photos;
use App\Jobs\SendVerificationEmail;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /*********************************************************************
     * Activate the user with given activation code.
     *********************************************************************
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
                $user = app(User::class)->where('activation_code', $activationCode)->first();
                if (!$user)
                {
                    return "The code does not exist for any user in our system.";
                }
                $user->status          = 1;
                //$user->activation_code = null;
                $user->save();
                //process payments if user is a school
                /*if($user->usable_type == 'App\School')
                {
                    $school = $user->usable;
                    $pricing = Pricing::where('country',$school->country)->first();

                    // Construct variables 
                    $cartTotal = $pricing->amount;// This amount needs to be sourced from your application
                    $data = array(
                        // Merchant details
                        'merchant_id' => '10011935', //change these variables later
                        'merchant_key' => 'otvxhp21fzovz',//change these variables later
                        'return_url' => route('payment-succesful'),
                        'cancel_url' => route('payment-cancelled'),
                        'notify_url' => 'http://test2.bana.vision/api/notify',
                        // Buyer details
                        'name_first' => $user->name,
                        'email_address'=> $user->email,
                        // Transaction details
                        'm_payment_id' => '8542', //Unique payment ID to pass through to notify_url
                        // Amount needs to be in ZAR
                        // If multicurrency system its conversion has to be done before building this array
                        'amount' => number_format( sprintf( "%.2f", $cartTotal ), 2, '.', '' ),
                        'item_name' => $pricing->product,
                        'item_description' => $pricing->description,
                        'custom_int1' => $user->id, //the id of the subscriber
                        'custom_int2' => $pricing->id,          
                        //subscription details
                        'subscription_type' => 1,
                        'frequency' => 3,
                        'cycles' => 0
                    );        

                    // Create parameter string
                    $pfOutput = '';
                    foreach( $data as $key => $val )
                    {
                        if(!empty($val))
                        {
                            $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
                        }
                    }
                    // Remove last ampersand
                    $getString = substr( $pfOutput, 0, -1 );
                    //Uncomment the next line and add a passphrase if there is one set on the account 
                    $passPhrase = 'Bana_subscription01';
                    if( isset( $passPhrase ) )
                    {
                        $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
                    }   
                    $data['signature'] = md5( $getString );

                    // If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
                    $testingMode = true;
                    $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
                    $htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">'; 
                    foreach($data as $name=> $value)
                    { 
                        $htmlForm .= '<input name="'.$name.'" type="hidden" value="'.$value.'" />'; 
                    } 
                    $htmlForm .= '<input name="signature" type="hidden" value="'.$data['signature'].'"/><button class="btn btn-default btn-sm" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    <button class="btn btn-success btn-sm pull-right" type="submit"><i class="fas fa-credit-card"></i> Submit Payment</button>
                    <button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;"><i class="fas fa-download"></i> Generate PDF</button>'; 
                    //echo $htmlForm;
                    return view('auth.register.payment.register-payment',['pricing'=>$pricing,'htmlForm'=>$htmlForm,'user'=>$user]);
            }*/
            auth()->login($user);
        }
    
        catch (\Exception $exception) 
        {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->route('all',['user'=>$user])->with(['message'=>'user successfully added']);
    }

 
    /***********************************************************
     * Post Request to store step1 info in session
     **********************************************************
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //'party'=> 'required|string',
        ]);
       
   /*
        if(empty($request->session()->get('user')))//theres no user on the session
        {*/
            //create new user
            //$user = new User();
            //$user->fill($validatedData);
            
            /*session(['user'=> $user]);
            session()->save();
        }
        else  //get user from the session
        {
            $user = $request->session()->get('user');
            $user->fill($validatedData);
            $user->slug = Str::slug($request['name'],'.');
            session(['user'=> $user]);
            session()->save();
        }
        $request->session()
        ->put('party', $validatedData['party']);*/

        return response()->json([
            //'party'=>$validatedData['party'],
            //'user'=>$user,
            //'next-step'=>'register-2'
        ]);
    }



    /******************************************************************
     * Post Request to store step1 info in session
     ******************************************************************
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {

        $user = $request->session()->get('user');
        $request->session()->put('user', $user);
            $validatedData;
            $school = null;
            $school_student = null;
            switch ($request->session()->get('party')) 
            {
                case 'Student':
                dd("am i even reaching here");
                $validatedData = $request->validate([
                    'gender'     => 'required|string',
                    'birthdate'    => 'required|string',
                    'institution' => 'required_with:id_number|string',
                    'grade'=> 'required|numeric',
                    'sector'=> 'string',
                    'id_number' => 'string',
                ]);
                    $school = User::where('name',$validatedData['institution'])->where('usable_type','App\School')->first();
                    if ($request['id_number']) //user chose to be linked with school
                    {
                        //check if records of student with similar id exists in school
                        $school_student = SchoolStudent::where('school_id',$school->id)
                        ->where('id_number',$validatedData['id_number'])
                        ->first();
                    }
                    unset($validatedData['institution']);
                    $validatedData['school_id'] = ($school ? $school->id : null); 
                    $student = new Student();
                    $student->fill($validatedData);
                    
                    
                    
                    /*$follow = new Like();
                    $follow->*/
                    $request->session()->put('student', $student);
                    $request->session()->save();
                    if ($school_student == null)
                    {
                        //school has no record of student with the same id
                        return response()->json([
                            'next-step'=>'register-final',
                            'session'=>$request->session()->all()
                        ]);
                    }
                    else
                    {
                        //student with same id number exists in the school
                        $request->session()
                        ->put('school_student_id', $school_student->id);
                        $request->session()->save();
                        $student->school_id = $school->id;

                        return response()->json([
                            'next-step'=>'register-final',
                            'session'=>$request->session()->all()
                        ]);
                    }
                    
                    break;

                 case 'School':
                    $validatedData = $request->validate([
                        'province' => 'required|string',
                        'district' => 'required|string',
                        'suburb' => 'required|string',
                        'country' => 'required|string',
                        'k_12' => 'required|string',
                        'coeducational' => 'required|string',
                        'funding' => 'required|string',
                        'pass_rate' => 'required|numeric',
                ]);

                    $validatedData['bana_email_address'] = $user->slug.'@schools.bana.vision';
                    $validatedData['bana_email_password'] = Str::random(16).time();

                    $school = new School();
                    $school->fill($validatedData);
                    $request->session()
                    ->put('school', $school);
                    $request->session()->save();
                    
                    return response()->json([
                        'next-step'=>'register-3'
                    ]);
                    break;

                    case 'Company':
                        $validatedData = $request->validate([
                            'registration_number' => 'required|string',
                            'registration_country' => 'required|string',
                            'registered_address_country' => 'required|string',
                            'registered_address_province' => 'required|string',
                            'registered_address_town' => 'required|string',
                            'registered_address_address' => 'required|string',
                            'registered_address_area_code' => 'required|string',
                        ]);
                        $company = new Company();
                        $company->fill($validatedData);
                        $request->session()
                        ->put('company',$company);
                        $request->session()->save();

                        return response()->json([
                            'next-step'=>'register-3'
                        ]);
                        break;

                    case 'Organization':
                        $validatedData = $request->validate([
                            'origin_country' => 'required|string',
                            'operation_area_country' => 'required|string',
                            'operation_area_province' => 'required|string',
                            'operation_area_town' => 'required|string',
                            'operation_area_area_code' => 'required|string',
                            'organization_type' => 'required|string',
                            'focus' => 'required|string',
                        ]);
                        $organization = new Organization();
                        $organization->fill($validatedData);
                        $request->session()
                        ->put('organization',$organization);
                        $request->session()->save();

                        return response()->json([
                            'next-step'=>'register-3'
                        ]);
                        break;
                
                default:
                    break;
            }
    }


    /*****************************************************************
    *
    ******************************************************************
    *
    *
    */
    public function createStepPicture(Request $request)
    {
        $user = $request->session()->get('user');
        $request->session()
        ->put('user', $user);
        return view('auth.register.register-picture',compact('user', $user));

    }

    /*****************************************************************
    *
    ******************************************************************
    *
    *
    */
    public function postCreateStepPicture(Request $request)
    {
        
        $validatedData = $request->validate([
                        'profilepic' => 'mimes:jpeg,bmp,png',
                ]);
        $file = $request->file('profilepic');
        $id =  str_random(30).time();
        
        Images::setImage($file,'-profilepic','tmp/',$id);
       $request->session()->put('picsrc', 'tmp/'.$id.'-profilepic'.'.jpg');
    }


    /*****************************************************************
    * final view/confirmation page
    ******************************************************************
    *@params object
    *@return redirect
    */
    public function postCreateStepFinal(Request $request)
    {
       
        $user = new User($request['user']);
        
       
   
        $userNumber = '';

            if(User::where('name',$request['user.name'])->get()) //check if there are users with same name
            {
                if (User::where('name',$request['user.name'])->count()  > 0) 
                {
                    $userNumber = User::where('name',$request['user.name'])->count()  + 1;
                }
            }
            
            $user->slug = Str::slug($request['user.name'].$userNumber,'.');
            //$user->password = bcrypt(Arr::get($request, 'password'));
            $user->password = bcrypt($request['user.password']);
            $user->activation_code = Str::random(30).time();

        $folders = array('cover','profile','post' );//default folders for all users
        
        switch ($request['Party']) {
            case 'Student':
                
                $zlto_token = $this->zlto();
                $zlto_my_uuid_id = $this->zlto_user_sign_up($zlto_token,$user->name,$user->email);
                $student_data = $request['Student'];
                $student_data['zlto_my_uuid_id'] = $zlto_my_uuid_id;

                $student = new Student($student_data);
                $student->save();
                $student->user()->save($user);
                $school_student_id = $request->session()->get('school_student_id');

                //$verify_student = $this->verify_student($request);

            

               /* if($verify_student['school_student_id'])//check if student exists in the school records
                {
                    $ssid = SchoolStudent::find($school_student_id);
                    $ssid->student_id = $student->id;
                    $ssid->update();
                }*/

                break;

            case 'School':
                $school = new School($request['School']);
                $school->user_name = $user->name;
                $school->user_slug = $user->slug;
                $school->bana_email_address = $user->slug.'@schools.bana.vision';
                $school->bana_email_password = Str::random(16).time();

                $school->save();
                if($school->user()->save($user))
                {
                    /*// Create a client with a base URI
                    $client = new Client(['base_uri' => '']);
                    // Send a request to https://foo.com/api/test
                    $response = $client->get('https://bana.vision:2083/execute/Email/add_pop?email='.$user->slug.'&password='.$school->bana_email_password.'&quota=500&domain=schools.bana.vision&skip_update_db=1',
                        [
                            'headers' => [
                                'Authorization' =>' cpanel wwwbana:SSZTGX8BXA2HKRHVGHNYVO95VN539UYX',
                            ],
                        ]);*/
                      /*  $passwd = hash("sha512", $school->bana_email_password);
                    $email_account = new AccountsTable ([
                        'DomainId'=>1,
                        'Email'=>$school->bana_email_address,
                        'password'=>$passwd

                    ]);
                    $email_account->save();*/ /// create school email account
                }
                $folders = array_merge($folders,array(
                    'books',
                    'bursary',
                    'events',
                    'needs_gratitude',
                    'needs_overview',
                    'our_need',
                    'student_awards',
                    'students',
                    'student_projects'
                ));//appends the default for all users
                break;

            case 'Company':
                $company = new Company($request['Company']);
                $company->save();
                $company->user()->save($user);
                break;

            case 'Organization':
                $organization = new Organization($request['organization']);
                $organization->save();
                $organization->user()->save($user);
                break;
            default:
                # code...
                break;
        }

        foreach ($folders as $key => $folder) #make folders for the user 
        {
            \Imagery::createFolder($user->slug.$user->id.'/'.$folder.'/');//use helper to create folders
        }
        //$user->notify(new UserRegisteredSuccessfully($user));//send verification email
        ///dispatch((new SendVerificationEmail($user))->delay(30));//use a queue and notification to send an email ###############uncomment please
        return response()->json([
            'message'=>'Successfully created a new account. Please check your email and activate your account.'
        ]);
    }

        public function zlto()
    {
        $client = new Client(); 
        $data=[
                    'grant_type' => 'client_credentials',
                    'client_id' => 'zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX',//$_ENV['ZLTO_CLIENT_ID'], // get id from the env file
                    'client_secret' =>'hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v' ,//$_ENV["ZLTO_CLIENT_SECRET"], // get secret from the env file
                    'redirect_uri' => 'https://bana.vision',
                    "scope" => "partner store earn client"
                ];

        $response = $client->post('https://staging-api.zlto.co/oauth/token/', ['json'=> $data] );






            $res_data = json_decode($response->getBody(), true);
            //dd($res_data['access_token']);
            session(['access_token'=>$res_data['access_token']]);
            //dd(session('access_token'));
            $token = $res_data['access_token'];

            return $token;

    }


    public function zlto_user_sign_up($token,$name,$email)
    {
        $client = new Client(['headers' => [
               'Authorization' => 'Bearer '.$token
           ]]); 
        $data=[
                 'name'=>$name,
                 'email' =>$email  
              ];

        $response = $client->post('https://staging-api.zlto.co/partner/signup/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        return $res_data['profile']['my_uuid_id'];//returns students zlto uuid
    }


    /*****************************************************************
    *  payfast notify page
    ******************************************************************
    *
    *
    */
    public function notify(Request $request)
    {
        /**
        * Notes:
        * - All lines with the suffix "// DEBUG" are for debugging purposes and
        *   can safely be removed from live code.
        * - Remember to set PAYFAST_SERVER to LIVE for production/live site
        * - If there is a passphrase set on the sandbox account, include it on line 68
        */
        // General defines
        define( 'PAYFAST_SERVER', 'TEST' ); // Whether to use "sandbox" test server or live server
        define( 'USER_AGENT', 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)' ); // User Agent for cURL

        // Error Messages
        define( 'PF_ERR_AMOUNT_MISMATCH', 'Amount mismatch' );
        define( 'PF_ERR_BAD_SOURCE_IP', 'Bad source IP address' );
        define( 'PF_ERR_CONNECT_FAILED', 'Failed to connect to PayFast' );
        define( 'PF_ERR_BAD_ACCESS', 'Bad access of page' );
        define( 'PF_ERR_INVALID_SIGNATURE', 'Security signature mismatch' );
        define( 'PF_ERR_CURL_ERROR', 'An error occurred executing cURL' );
        define( 'PF_ERR_INVALID_DATA', 'The data received is invalid' );
        define( 'PF_ERR_UNKNOWN', 'Unknown error occurred' );

        // General Messages
        define( 'PF_MSG_OK', 'Payment was successful' );
        define( 'PF_MSG_FAILED', 'Payment has failed' );

        // Notify PayFast that information has been received
        header( 'HTTP/1.0 200 OK' );
        flush();

        // Variable initialization
        $pfError = false;
        $pfErrMsg = '';
        $filename = '/'.storage_path().'/notify.txt'; // DEBUG
        $output = ''; // DEBUG
        $pfParamString = '';
        $pfHost = ( PAYFAST_SERVER == 'LIVE' ) ? 'www.payfast.co.za' : 'sandbox.payfast.co.za';
        $pfData = array();
        $output = "ITN Response Received\n\n";

        //// Dump the submitted variables and calculate security signature
        if ( !$pfError )
        {
            $output .= "Posted Variables eish:\n"; // DEBUG
            // Strip any slashes in data
            foreach ( $_POST as $key => $val )
            {
                $pfData[$key] = stripslashes( $val );
                $output .= "$key = $val\n";
            }
            $payment = new Payment();
            $payment->m_payment_id = $pfData['m_payment_id'];
            $payment->amount =$pfData['amount_gross'] ;
            $payment->item_name = $pfData['item_name'];
            $payment->item_description =$pfData['item_description'];
            $payment->user_id =$pfData['custom_int1'];
            $payment->pricing_id =$pfData['custom_int2'];
            $payment->token =$pfData['token'];
            $payment->payment_status =$pfData['payment_status'];
            $payment->pf_payment_id =$pfData['pf_payment_id'];
            $payment->save();
            // Dump the submitted variables and calculate security signature
            foreach ( $pfData as $key => $val )
            {
                if ( $key != 'signature' )
                {
                    $pfParamString .= $key . '=' . urlencode( $val ) . '&';
                }

            }

            // Remove the last '&' from the parameter string
            $pfParamString = substr( $pfParamString, 0, -1 );
            $pfTempParamString = $pfParamString;

            // If a passphrase has been set in the PayFast Settings, include it in the signature string.
            $passPhrase = 'Bana_subscription01'; //You need to get this from a constant or stored in your website/database
            if ( !empty( $passPhrase ) )
            {
                $pfTempParamString .= '&passphrase=' . urlencode( $passPhrase );
            }
            $signature = md5( $pfTempParamString );

            $result = ( $_POST['signature'] == $signature );

            $output .= "\nSecurity Signature:\n"; // DEBUG
            $output .= "- posted     = " . $_POST['signature'] . "\n"; // DEBUG
            $output .= "- calculated = " . $signature . "\n"; // DEBUG
            $output .= "- result     = " . ( $result ? 'SUCCESS' : 'FAILURE' ) . "\n"; // DEBUG

            if( !$result )
            {
                $pfError =  true;
                $pfErrMsg = PF_ERR_INVALID_SIGNATURE;
            }
        }

        //// Verify source IP
        if ( !$pfError )
        {
            $validHosts = array(
                'www.payfast.co.za',
                'sandbox.payfast.co.za',
                'w1w.payfast.co.za',
                'w2w.payfast.co.za',
            );

            $validIps = array();

            foreach ( $validHosts as $pfHostname )
            {
                $ips = gethostbynamel( $pfHostname );

                if ( $ips !== false )
                {
                    $validIps = array_merge( $validIps, $ips );
                }
            }

            // Remove duplicates
            $validIps = array_unique( $validIps );

            if ( !in_array( $_SERVER['REMOTE_ADDR'], $validIps ) )
            {
                $pfError = true;
                $pfErrMsg = PF_ERR_BAD_SOURCE_IP;
            }
        }

        //// Connect to server to validate data received
        if ( !$pfError )
        {
            // Use cURL (If it's available)
            if ( function_exists( 'curl_init' ) )
            {
                $output .= "\nUsing cURL\n"; // DEBUG

                // Create default cURL object
                $ch = curl_init();

                // Base settings
                $curlOpts = array(
                    // Base options
                    CURLOPT_USERAGENT => USER_AGENT, // Set user agent
                    CURLOPT_RETURNTRANSFER => true, // Return output as string rather than outputting it
                    CURLOPT_HEADER => false, // Don't include header in output
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_SSL_VERIFYPEER => 1,

                    // Standard settings
                    CURLOPT_URL => 'https://' . $pfHost . '/eng/query/validate',
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $pfParamString,
                );
                curl_setopt_array( $ch, $curlOpts );

                // Execute CURL
                $res = curl_exec( $ch );
                curl_close( $ch );

                if ( $res === false )
                {
                    $pfError = true;
                    $pfErrMsg = PF_ERR_CURL_ERROR;
                }
            }
            // Use fsockopen
            else
            {
                $output .= "\nUsing fsockopen\n"; // DEBUG

                // Construct Header
                $header = "POST /eng/query/validate HTTP/1.0\r\n";
                $header .= "Host: " . $pfHost . "\r\n";
                $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
                $header .= "Content-Length: " . strlen( $pfParamString ) . "\r\n\r\n";

                // Connect to server
                $socket = fsockopen( 'ssl://' . $pfHost, 443, $errno, $errstr, 10 );

                // Send command to server
                fputs( $socket, $header . $pfParamString );

                // Read the response from the server
                $res = '';
                $headerDone = false;

                while ( !feof( $socket ) )
                {
                    $line = fgets( $socket, 1024 );

                    // Check if we are finished reading the header yet
                    if ( strcmp( $line, "\r\n" ) == 0 )
                    {
                        // read the header
                        $headerDone = true;
                    }
                    // If header has been processed
                    else if ( $headerDone )
                    {
                        // Read the main response
                        $res .= $line;
                    }
                }
            }
        }

        //// Get data from server
        if ( !$pfError )
        {
            // Parse the returned data
            $lines = explode( "\n", $res );

            $output .= "\nValidate response from server:\n"; // DEBUG

            foreach ( $lines as $line ) // DEBUG
            {
                $output .= $line . "\n";
            }
            // DEBUG
        }

        //// Interpret the response from server
        if ( !$pfError )
        {
            // Get the response from PayFast (VALID or INVALID)
            $result = trim( $lines[0] );

            $output .= "\nResult = " . $result; // DEBUG

            // If the transaction was valid
            if ( strcmp( $result, 'VALID' ) == 0 )
            {
                // Process as required
            }
            // If the transaction was NOT valid
            else
            {
                // Log for investigation
                $pfError = true;
                $pfErrMsg = PF_ERR_INVALID_DATA;
            }
        }

        // If an error occurred
        if ( $pfError )
        {
            $output .= "\n\nAn error occurred!";
            $output .= "\nError = " . $pfErrMsg;
        }

        //// Write output to file // DEBUG
        file_put_contents( $filename, $output ); // DEBUG

    }

    public function verify_student($request)
    {
        $school = User::where('name',$request['Student.institution'])->where('usable_type','App\School')->first();
        if ($request['Student.id_number']) //user chose to be linked with school
        {
            //check if records of student with similar id exists in school
            $school_student = SchoolStudent::where('school_id',$school->id)
            ->where('id_number',$request['id_number'])
            ->first();
        }

        $school_id = ($school ? $school->id : null); 
        //$student = new Student();
        //$student->fill($validatedData);
        $arr =  ['school_id'=>$school_id];   
                    
        if ($school_student !== null)
        {
            //student with same id number exists in the school
            $student_school_id = $school->id;
            $arr['student_school_id'] = $school->id;
        }

        return $arr;
    }

}




        
    
