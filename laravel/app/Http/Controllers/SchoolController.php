<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\Rating;
use App\Staff;
use App\SchoolClass;
use App\SchoolStudent;
use App\Guardian;
use App\Curriculumn;
use App\Teacher;
use App\Image;
use Photos;
use App\TeacherProficiency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Mapper;
use Illuminate\Http\Response;

class SchoolController extends Controller
{
  /*****************************************************  
  * GET THE SCHOOLPAGE
  ******************************************************
  *
  *
  *
  */
	public function getSchoolsPage($province = 'all')
	{
		//$post = Post::where('id',$post_id)->first();

		function getSchoolByProvince($something)
		{   
		    $schools = School::where('province',$something)->get();
			if($schools )
			{
				//$schoolName =  new Collection;
				foreach ($schools as $key=>$school)
				{
					$schools[$key] = $school->user()->first();
				}
				return response()->json(['posts'=>$schools]);
			}
			else
			{
				return response()->json(['error'=>'error']);
			}
		}

		
		if($province)
		{
      switch ($province)
      {
       case "eastern-cape":
       return getSchoolByProvince($province);
       break;

       case "free-state":
       return getSchoolByProvince($province);
       break;

       case "gauteng":
       return getSchoolByProvince($province);
       break;

       case "kwazulu-natal":
       return  getSchoolByProvince($province);
       break;

       case "limpopo":
       return getSchoolByProvince($province);
       break;

       case "mpumalanga":
       return getSchoolByProvince($province);
       break;

       case "north-west":
       return  getSchoolByProvince($province);
       break;

       case "northern-cape":
       return  getSchoolByProvince($province);
       break;

       case "western-cape":
       return  getSchoolByProvince($province);
       break;

       case "all":
       $schools = School::
       with('user')->
       paginate(5);

       dd($schools);

       return response()->json(['posts1'=>$schools->getCollection()]);
       break;


       default:
     }
   }


}

  /**********************************************************
  *
  ***********************************************************
  *
  *
  *
  */
  public function pdfview(Request $request)
  {

    $users = DB::table("users")->get();

    view()->share('users',$users);



    if($request->has('download'))
    {

      $pdf = PDF::loadView('auth.register');
      return $pdf->download('pdfview.pdf');

    }
    //return view('pdfview');
    return $pdf->stream();
  }
  /*****************************************************
  *
  ******************************************************
  *
  *
  *
  */
  public function getMakeTimetablePage(User $user)
  {
  	return view('school.makeTimetable',['userIdNo' => $user]);
  }

  /*****************************************************
  *
  ******************************************************
  *
  *
  *
  */
  public function createTimetable(Request $request)
  {
  	dd($request);
  	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
  }

  /*****************************************************
  *
  ******************************************************
  *
  *
  *
  */
  public function createRating(Request $request)
  {
  	
  	$userId = Auth::id();
  	$schoolId = User::where('slug',$request['schoolUserId'])->first()->usable_id;
  	$rate = $request['rating'];
  	$review = $request['review'];
  	$rating = new Rating();
  	$rating->user_id = $userId;
  	$rating->school_id = $schoolId;
  	$rating->rating = $rate;
  	$rating->review = $review;
  	$rating->save();
  	
  	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
  }

  /*****************************************************
  *
  ******************************************************
  *
  *
  *
  */
  public function getRating($schoolId)
  {

  }

  /*****************************************************************
  * create classes for a school
  ******************************************************************
  *@params Request
  *@return view
  */
  public function createSchoolClass(Request $request)
  {
  	$this->validate($request,[
    		'school_id' =>'required|numeric|min:1',
    		'class_name' => 'required|string|min:1|max:1',
    		'grade' => 'required|numeric|min:0|max:12',
    		'teacher_id' =>'required|numeric|min:1'
    	]);
  	$school_class = new SchoolClass();
  	$school_class->school_id = $request['school_id'];
  	$school_class->class_name = $request['class_name'];
  	$school_class->grade = $request['grade'];
  	$school_class->teacher_id = $request['teacher_id'];
  	$school_class->save();
  	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
  }

  /****************************************************************
  * create student for a school
  *****************************************************************
  *@params Request
  *@return view
  *
  */
  public function createSchoolStudent(Request $request)
  {
  	$this->validate($request,[
  		'name' =>'required|string',
  		'surname' =>'required|string',
  		'id_number' =>'required|string',
  		'guardian' =>'required|string',
  		'grade' =>'required|numeric',
  		'class_' =>'required|string',
  		'year' =>'required|string',
  		'student_number' =>'required|string',
  		'disability' =>'string',
  		'gender' =>'required|string',
  		'special_medication' =>'string',
  		'medical_condition' =>'string',
  		'previous_school' =>'required|string',
  		'previous_grade' =>'required|numeric|max:12',
   ]);

    $school_student = new SchoolStudent();
    foreach ($request->all() as $key => $req) 
    {
      $school_student->$key = $req;
    }
    
    if(Auth::user()->usable->schoolStudents()->save($school_student))
    {
      \Imagery::createFolder(Auth::user()->slug.'/students/'.$school_student->id);

      $file = $request->file('image');
      #upload the image as a post 

      $path = Auth::user()->slug.'/students/'.$school_student->id.'/profile/';


      $image = new Image([
        'path' => $path,
        'name' => $file->extension()
      ]);
      $school_student->images()->save($image);
      $image->update(['name'=>$image->id.'.'.$image->name]);

    # use helper to store the image 
      \Imagery::setImage($file->extension(),$file,'profile','students',Auth::user(),$image->id,$school_student);

      return response()->json([
        'message'=>'the student has been created successfully',
        'post'=> $school_student
      ]);
    }

  }

  /*************************************************************
  *
  **************************************************************
  *
  *
  */
  public function createGuardian(Request $request)
  {
  	$this->validate($request,[
  		'school_id' =>'required|numeric|min:1',
		'title' =>'required|string',
		'gender' =>'required|string',
		'name' =>'required|string',
		'surname' =>'required|string',
		'school_student_id' =>'required|numeric|min:1',
		'contact_number' =>'required|string',
		'postal_address' =>'required|string',
		'postal_code' =>'required|string',
		'city' =>'required|string',
		'street_name' =>'required|string',
		'house_number' =>'required|string',
		'relationship_to_student' =>'required|string',
		'id_number' =>'required|string',
		'employment_status' =>'required|string',
		'job_sector' =>'required|string',
		'company' =>'required|string',
    	]);

  	$guardian = new Guardian();
  	$guardian->school_id=$request['school_id'];
  	$guardian->title=$request['title'];
  	$guardian->gender=$request['gender'];
  	$guardian->name=$request['name'];
  	$guardian->surname=$request['surname'];
  	$guardian->school_student_id=$request['school_student_id'];
  	$guardian->contact_number=$request['contact_number'];
  	$guardian->postal_address=$request['postal_address'];
  	$guardian->postal_code=$request['postal_code'];
  	$guardian->city=$request['city'];
  	$guardian->street_name=$request['street_name'];
  	$guardian->house_number=$request['house_number'];
  	$guardian->relationship_to_student=$request['relationship_to_student'];
  	$guardian->id_number=$request['id_number'];
  	$guardian->employment_status=$request['employment_status'];
  	$guardian->job_sector=$request['job_sector'];
  	$guardian->company=$request['company'];
  	$guardian->save();
  	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
  }

  /************************************************************
  *
  *************************************************************
  *
  *
  *
  */
  public function teacherHome(User $user,$teacher_id)
  {
        $school_students = SchoolStudent::where('school_id',$user->school->id)->get();
        $subjects = Curriculumn::where('school_id',$user->school->id)->get();
        $school_classes = SchoolClass::where('school_id',$user->school->id)->get();
        return view('teacherAttendence',['userIdNo'=>$user,'subjects'=>$subjects,'school_students'=>$school_students,'school_classes'=>$school_classes]);
  }

  public function getSubfolderPic($filename,$folder = 'post')
  {
    

    #uses helper to check if profile pic exists
    return new Response(\Imagery::getImage(str_replace('-','/',$folder).$filename,'avatar.jpg'),200);
    
  }

  /*****************************************************************
  *
  ******************************************************************
  *
  */
  public function getSchoolStudents(User $user,$grade,$class)
  {

      $students = SchoolStudent::where('school_id',Auth::user()->usable_id)->where('grade',$grade)->where('class',$class)->get();
      return response()->json(['students'=>$students],200);
  }

  /**
   * [getAdminPage description]
   * @param  User    $user    [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function getAdminPage(User $user,Request $request)
  {
    # get the school's teachers 
    $staff = $user->usable->staff()
    ->paginate(6)
    ->setPageName('page2');

    # get the school's students
    $students = $user->usable->schoolStudents()
    ->paginate(6)
    ->setPageName('page1');
   
    #for lazy loading when the user scrolls down
    if ($request->ajax()) 
    {
      if($request->filled('page1')) //if the request is from cover tab
      {
        $students = SchoolStudent::where('school_id',$user->usable_id)
        ->with('studentMisconduct')
        ->with('requestedBook.libraryBook.book.images')
        ->with('checkedOutBook.requestedBook.libraryBook.book.images')
        ->with('images')
        ->with('loanedBook.books.images')
        ->paginate(6,['*'],'student',$_GET['page1']);
        return response()->json([
          'posts'=>$students->getCollection()
        ]);
      }
      else if($request->filled('page2'))
      {
        $staff = Staff::where('school_id',$user->usable_id)
        ->with('user.images')
        ->with('teacher')
        ->paginate(6,['*'],'staff',$_GET['page2']);
        return response()->json([
          'posts'=>$staff->getCollection()
        ]);
      }
    }

    return view('school.admin.adminPage',[
      'userIdNo'=>$user,
      'staff'=>$staff,
      'students'=>$students
    ]);
  }

  /******************************************************************
  *
  *******************************************************************
  *
  *
  */
  public function getSchoolPictures(User $user,$school_student_id)
  {
    $path = '';
    $name = '';
    if($image = Image::where('imageable_type','App\SchoolStudent')->where('imageable_id',$school_student_id)->first())
    {
        $path = $image->path;
        $name = $image->name;
    }
    return new Response(\Imagery::getImage($path.$name,'avatar.jpg'),200);
  }
  /**
   * [filterSchools description]
   * @param  [type] $filter_type      [description]
   * @param  [type] $filter_parameter [description]
   * @return [type]                   [description]
   */
  public function filterSchools($filter_type,$filter_parameter)
  {
    $schools = null;
    switch ($filter_type) 
    {

      case 'coeducational':
      $schools = School::where('coeducational',$filter_parameter)
      ->whereHas('user' , function($query) {
        $query->whereNotNull('id');
      })
      ->with('user.imageable')
      ->withCount('shares')
      ->limit(25)
      ->get();
      break;

      case 'funding':
      $schools = School::where('funding',$filter_parameter)
      ->whereHas('user' , function($query) {
        $query->whereNotNull('id');
      })
      ->with('user.imageable')
      ->withCount('shares')
      ->limit(25)
      ->get();
      break;

      case 'k_12':
      $schools = School::where('k_12',$filter_parameter)
      ->whereHas('user' , function($query) {
        $query->whereNotNull('id');
      })
      ->with('user.imageable')
      ->withCount('shares')
      ->limit(25)
      ->get();
      break;

      case 'special_needs':
      $schools = School::where('special_needs',$filter_parameter)
      ->whereHas('user' , function($query) {
        $query->whereNotNull('id');
      })
      ->with('user.imageable')
      ->withCount('shares')
      ->limit(25)
      ->get();
      break;

      case 'curriculumn_type':
      $schools = School::where('curriculumn_type',$filter_parameter)
      ->whereHas('user' , function($query) {
        $query->whereNotNull('id');
      })
      ->with('user.imageable')
      ->withCount('shares')
      ->limit(25)
      ->get();
      break;

      case 'school_name':
      $schools = School::whereHas('user' , function($query) use ($filter_parameter) {
        $query->where('name', 'LIKE', '%' . $filter_parameter . '%')->distinct();
      })
      ->with('user.imageable')
      ->withCount('shares')
      ->limit(25)
      ->get();
      break;


      default:
                # code...
      break;
    }
    return response()->json(['posts'=>$schools]);
  }

  public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
  {
   $schools = array();
   switch ($suggest_type) 
   {



    case 'facility':
    $schools_query = School::whereHas('facility' , function($query) use ($suggest_parameter) {
      $query->where('facility_name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
    })
    ->limit(25)
    ->orderBy('created_at', 'desc')
    ->with('user')
    ->get();

    foreach ($schools_query as $key => $nq)
    {
                    //iterate over the school students
      $facility_name = $nq->facility_name;

                    //check if the student is same as the one searched for
      if (strpos($facility_name, $suggest_parameter) !== false && !in_array($facility_name, $schools))
      {
        array_push($schools, $facility_name);
      } 
    }
    break;


    case 'school_name':
    $schools_query = School::whereHas('user' , function($query) use ($suggest_parameter) {
      $query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
    })
    ->limit(25)
    ->with('user')
    ->get();

    foreach ($schools_query as $key => $sq)
    {
                    //iterate over the school students
      $name = $sq->user->first()->name;

                    //check if the student is same as the one searched for
      if (strpos($name, $suggest_parameter) !== false && !in_array($name, $schools))
      {
        array_push($schools, $name);
      } 
    }
    break;

    default:
                # code...
    break;
    }
      return response()->json(['posts'=>$schools]);
  }

  public function getCurriculumn($schoolId)
  {
    $curriculumn = Curriculumn::where('school_id',$schoolId)->get();
    return response()->json(['message'=>'youre here','posts'=>$curriculumn]);
  }

  public function index()
  {
    /*$school_users = User::where('usable_type','App\School')->get();
    $schools=[];
    foreach ($school_users as $school_user) {
      array_push($schools,$school_user->usable);
    }*/
    $schools = School::with('user')->paginate(5)->all();
    return response()->json(['posts1'=>$schools]);
  }

  public function show(User $user)
  {
    $school = $user->usable;
    return response()->json(['posts1'=>array($school),'user'=>$user]);
  }


}

