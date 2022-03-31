<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\StudentAward;
use App\FeaturedStudent;
use App\StudentsProject;
use App\SchoolStudent;
use App\Image;
use App\Comment;
use App\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentAwardController extends Controller
{
    
 

    //GET THE SCHOOLPAGE

	/**
	 * [getGeneralStudentAwardsPage description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function getGeneralStudentAwardsPage(Request $request)
	{
		$student_award = StudentAward::latest()
		->limit(40)
		->orderBy('created_at', 'desc')
		->with('schoolStudent.images')
		->withCount('comments')
		->withCount('likes')
		->withCount('shares')
		->with('schoolStudent.school.user')
		->with('images')
		->paginate(5)
		->setPageName('page1');
		//the request is from ajax loading more data
		if ($request->ajax()) 
		{
    		$student_award = StudentAward::latest()
    		->orderBy('created_at', 'desc')
    		->with('schoolStudent.images')
    		->withCount('comments')
    		->withCount('likes')
    		->with('images')
			->withCount('shares')
			->with('schoolStudent.school.user')
			->paginate(5,['*'],'page1',$_GET['page1'])
			->getCollection();
            return response()->json(['posts'=>$student_award]);
        }
		return view('student.award.generalStudentAwardsPage',['posts'=>$student_award->getCollection()]);
	}

	/******************************************************************
    *
    *******************************************************************
    *
    *
    *
    */
	public function getStudentAwardsPage(User $user,Request $request)
	{
		$students = $user->usable->schoolStudents;
		$featured_students = $user->usable->featuredStudents()
		->paginate(9,['*'])
		->setPageName('page1');

		$students_projects = $user->usable->studentProjects()
		->paginate(9,['*'])
		->setPageName('page3');

		$student_awards = $user->usable->studentAwards()
		->paginate(9)
		->setPageName('page2'); 
		
		if ($request->ajax()) //request is from lazy loading
		{
			if($request->filled('page2')) //if the request is from awards tab
			{
				$page = $request['page2'];
            	if($page > 1)
            	{
                	$keya = $page*3 -1; //$keya is the array key for each chunk to show the collapse
                	$student_awards = StudentAward::where('school_id',$user->usable_id)
                	->with('images')
                	->paginate(9,['*'],'page2',$_GET['page2']); 
					$view = view('student.award.studentAwardData',[
						'userIdNo' => $user,
						'student_awards'=>$student_awards,
						'keya'=>$keya
					])->render();
            	}
            	return response()->json([
            		'posts'=>$student_awards->getCollection(),
            		'keya'=>$keya
            	]);
			}
			else if ($request->filled('page1')) //this request is from feature tab
			{
				$page = $request['page1'];
            	if($page > 1)
            	{
            		$keyb = $page*3 -1; //$keya is the array key for each chunk to show the collapse
					$featured_students = FeaturedStudent::where('school_id',$user->usable_id)
					->paginate(9,['*'],'page1',$_GET['page1']);
					$view = view('student.featured.featuredStudentData',[
						'userIdNo' => $user,
						'featured_students'=>$featured_students,
						'keyb'=>$keyb
					])->render();
				}
            	return response()->json([
            		'posts'=>$featured_students->getCollection(),
            		'keyb'=>$keyb
            	]);
			}
			else  // feature is from project tab
			{
				$page = $request['page3'];
            	if($page > 1)
            	{
            		$keyc = $page*3 -1; //$keya is the key for each chunk to show the collapse
					$students_projects = StudentsProject::where('school_id',$user->usable_id)
					->with('images')
					->with('schoolStudents')
					->paginate(9,['*'],'page3',$_GET['page3']);
					$view = view('student.project.studentProjectData',[
						'userIdNo' => $user,
						'students_projects'=>$students_projects,
						'keyc'=>$keyc
					])->render();
				}
            	return response()->json([
            		'posts'=>$students_projects->getCollection(),
            		'keyc'=>$keyc
            	]);
			}
			
		}
		return view('student.award.studentAwardsPage',[
			'userIdNo' => $user,
			'featured_students'=>$featured_students,
			'student_awards'=>$student_awards,
			'students'=>$students,
			'students_projects'=>$students_projects,
			'keya'=>0,
			'keyb'=>0,
			'keyc'=>0]);
	}

	/******************************************************************
    *
    *******************************************************************
    *
    *
    *
    */
	public function createFeaturedStudent(Request $request)
	{
		$this->validate($request,[
			'school_student_ids'=>'string|min:1',
			'achievements'=>'required|string|max:1000',
		]);

		$user = Auth::user();
		$featured_student = new FeaturedStudent();
		$featured_student->achievements = $request['achievements'];
		$featured_student->school_student_id = $request['school_student_id'];
		

		$img = $user->usable
		->schoolStudents()
		->where('id',$request['school_student_id'])
		->first()
		->images()
		->first();
		
		$image = new Image([
			'name' => $img->name,
			'path'=>$img->path
		]);

		if($user->usable->featuredStudents()->save($featured_student))
		{
			$featured_student->images()->save($image);
		}

		return response()->json(['posts'=>$featured_student]);
	}

    /******************************************************************
    *
    *******************************************************************
    *
    *
    *
    */
    public function createStudentAward(Request $request)
	{
		$this->validate($request,[
			'school_student_id'=>'required|string',
			'description'=>'required|string|max:1000',
			'field'=>'required|min:6|max:250',
			'year'=>'required|numeric|min:2019',
			'awarded_by'=>'required|min:6|max:250',
			'student_award_photo'=>'required|file|mimes:jpeg,bmp,png'
		]);
		$user = Auth::user();
		$student_award = new StudentAward();

        foreach ($request->all() as $key => $req) 
        {
          ($req=='student_award_photo' || $req=='_token')?:($student_award->$key = $req);
        }

		if($user->usable->studentAwards()->save($student_award))
		{
			$file = $request['student_award_photo'];
			if($file)
			{
				$picture_type = 'student_awards';

				$image = new Image([
					'path' => Auth::user()->slug.'/student_awards/',
					'name' => $student_award->id.'.'.$file->extension()
				]);
				$student_award->images()->save($image);

				\Imagery::setImage($file->extension(),$file,$picture_type,null,$user,$student_award->id);
			}
		}
		return response()->json(['posts'=>$student_award]);
	}


	public function filterStudentAward($filter_type,$filter_parameter)
	{
		$awards = null;
		switch ($filter_type) 
		{
			case 'country':
				$awards = StudentAward::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('country', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'province':
				$awards = StudentAward::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('province', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'town':
				$awards = StudentAward::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('town', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'suburb':
				$awards = StudentAward::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('suburb', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'awarder_name':
				$awards = StudentAward::where('awarded_by', 'LIKE', '%' . $filter_parameter . '%')
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'award_awardee':
				$awards = StudentAward::whereHas('schoolStudent' , function($query) use ($filter_parameter) {
   					$query->where('name', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'field':
				$awards = StudentAward::where('field', 'LIKE', '%' . $filter_parameter . '%')
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'year':
				$awards = StudentAward::where('year',$filter_parameter)
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'school_name':
				$awards = StudentAward::whereHas('schoolStudent.school.user' , function($query) use ($filter_parameter) {
   					$query->where('name', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;
			
			default:
				# code...
				break;
		}

		return response()->json(['posts'=>$awards]);
	}

	public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
	{
		$awards = array();
		switch ($suggest_type) 
		{
			case 'awarder_name':
				$awards_query = StudentAward::where('awarded_by','LIKE','%'.$suggest_parameter.'%')
				->groupBy('awarded_by')
				->distinct()
				->limit(25)
				->orderBy('created_at', 'desc')
				->get();

				foreach ($awards_query as $key => $aq)
				{
					array_push($awards, $aq->awarded_by);
				}
				break;

			case 'award_awardee':

				$awards_query = StudentAward::whereHas('schoolStudent' , function($query) use ($suggest_parameter) {
   					$query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
				})
				->distinct()
				->with('schoolStudent')
				->orderBy('created_at', 'desc')
				->get();
				//iterate over the projects
				foreach ($awards_query as $key => $aq)
				{
					$school_student = $aq->schoolStudent;
						//check if the student is same as the one searched for
						if (strpos($school_student->name, $suggest_parameter) !== false || strpos($school_student->name, $suggest_parameter) !== false )
						{
							if( !in_array($school_student->name, $awards))
							{
								array_push($awards, $school_student->name);
							}
						}
					
				}
				break;

			case 'field':
				$awards_query = StudentAward::where('field', 'LIKE', '%' . $suggest_parameter . '%')
				->limit(25)
				->orderBy('created_at', 'desc')
				->get();

				foreach ($awards_query as $key => $aq)
				{
					//iterate over the school students
					$field = $aq->field;
					
						//check if the student is same as the one searched for
						if (strpos($field, $suggest_parameter) !== false && !in_array($field, $awards))
						{
							array_push($awards, $field);
						}	
				}
				break;

			case 'school_name':
				$projects_query = StudentAward::whereHas('schoolStudent.school.user' , function($query) use ($suggest_parameter) {
   					$query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->groupBy('name')->distinct();
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->get();

				foreach ($projects_query as $key => $pq)
				{
					//iterate over the school students
					$name = $pq->schoolStudent->school->user->first()->name;
					
						//check if the student is same as the one searched for
						if (strpos($name, $suggest_parameter) !== false && !in_array($name, $awards))
						{
							array_push($awards, $name);
						}
					
					
				}
				break;
			
			default:
				# code...
				break;
		}

			return response()->json(['posts'=>$awards]);

	}

	/**
	 * [deleteStudentAward description]
	 * @param  [type] $studentAwardId [description]
	 * @return [type]                 [description]
	 */
	public function deleteStudentAward($studentAwardId)
    {
        $student_award = StudentAward::where('id',$studentAwardId)->first();
        $images = $student_award->images;
        $comments = Comment::where('commentable_id',$studentAwardId)->where('commentable_type','App\StudentAward')->get();
        if ($student_award->delete())
        {
            #use helper to delete bursary image
            \Imagery::deleteImage($images);

            $likes = Like::where('likeable_id',$studentAwardId)->where('likeable_type','App\StudentAward')->get();
            foreach($comments as $comment) //deletes each image on the database
            {
                $comment->delete();
            }

            foreach($likes as $like)
            {
                $like->delete();
            }
        }
        
        return response()->json(['message'=>"successfully deleted post"]);
    }


    public function index(User $user)
    {
    	$student_awards =$user->usable->studentAwards()
			->orderBy('created_at', 'desc')
			->paginate(5)
			->all();
            return response()->json(['user' => $user,'posts1'=>array_values($student_awards)]);
    }
}