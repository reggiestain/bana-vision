<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\SchoolStudent;
use App\StudentsProject;
use App\StudentsStudentsProject;
use App\Image;
use App\Comment;
use App\Like;
use App\Share;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Photos;
use Illuminate\Http\Response;


class StudentProjectController extends Controller
{

    //GET THE SCHOOLPAGE


	public function getGeneralStudentProjectsPage(Request $request)
	{
		$projects = StudentsProject::latest()
		->limit(40)
		->orderBy('created_at', 'desc')
		->with('schoolStudents')
		->with('school.user')
		->with('images')
		->withCount('comments')
		->withCount('likes')
		->withCount('shares')
		->paginate(5)
		->setPageName('page1');
		//the request is from ajax loading more data
		if ($request->ajax()) 
		{
    		$projects = StudentsProject::latest()
    		->orderBy('created_at', 'desc')
    		->with('schoolStudents')
    		->with('school.user')
    		->with('images')
    		->paginate(5,['*'],'page1',$_GET['page1'])
    		->getCollection();
            return response()->json(['posts'=>$projects]);
        }
		return view('student.project.generalStudentProjectsPage',['posts'=>$projects->getCollection()]);
	}

	public function getStudentProjectsPage(User $user)
	{
	
		$school = $user->usable;
		/////dd($school->studentProjects);

		/*$project = StudentsProject::where('school_id',$userIdNumber->usable_id)->join('students_project_participants','students_projects.id','=','students_project_participants.student_project_id')->groupBy('students_projects.id')->get();
		$result = StudentsProject::where('school_id',$userIdNumber->usable_id);
		dd(User::find($userId)->schools());
		
		$students = Student::where('school_id',$userIdNumber->usable_id)->join('users',function($join){
				$join->on('students.id','=','users.usable_id')
				->where('usable_type','App\Student');
			})->paginate(25);*/
		return view('student.project.studentProjectsPage',['userIdNo' => $user,'school'=>$school/*,'students'=>$students*/]);
	}

	public function createStudentsProject(Request $request)
	{
		
		$this->validate($request,[
        	'description'=>'required|max:420',
        	'name'=>'required|max:120',
        	'category'=>'required|max:120',
        	'participants'    => 'required|array|min:1',
            //'student_id.*'  => 'required|numeric|distinct|min:3',
            'participants.required'    => 'please add student participants',
        	
        	]);
		$user = Auth::user();
		// create student project 
		$studentsProject = new StudentsProject([
			'name' => $request['name'],
			'description' => $request['description'],
			'category' => $request['category'],
		]);


		if(Auth::user()->usable->studentProjects()->save($studentsProject))
		{
			//assing students to student project 
			foreach ($request['participants'] as $participant) 
			{	
				$prtcpnt = new SchoolStudent($participant);
				$studentsProject->schoolStudents()->save($prtcpnt);
			}
			//save project image 
			$file = $request->file('project-image');
				
			if($file)
			{
				$picture_type = 'student_projects';

				$image = new Image([
					'path' => Auth::user()->slug.'/student_projects/',
					'name' => $studentsProject->id.'.'.$file->extension()
				]);
				$studentsProject->images()->save($image);

				\Imagery::setImage($file->extension(),$file,$picture_type,null,$user,$studentsProject->id);
			}

			return response()->json(['post'=>$studentsProject]);
		}
	 
	}

	public function getProjectPic($filename)
	{
		#uses helper to check if profile pic exists
		return new Response(\Imagery::getImage($filename,'avatar.jpg'),200);
		
	}

	public function filterStudentProject($filter_type,$filter_parameter)
	{
		$projects = null;
		switch ($filter_type) 
		{
			case 'country':
				$projects = StudentsProject::whereHas('school' , function($query) use ($filter_parameter) {
   					$query->where('country', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'province':
				$projects = StudentsProject::whereHas('school' , function($query) use ($filter_parameter) {
   					$query->where('province', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'town':
				$projects = StudentsProject::whereHas('school' , function($query) use ($filter_parameter) {
   					$query->where('town', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'suburb':
				$projects = StudentsProject::whereHas('school' , function($query) use ($filter_parameter) {
   					$query->where('suburb', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'project_name':
				$projects = StudentsProject::where('name', 'LIKE', '%' . $filter_parameter . '%')
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'project_participant':
				$projects = StudentsProject::whereHas('schoolStudents' , function($query) use ($filter_parameter) {
   					$query->where('name', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'category':
				$projects = StudentsProject::where('category', 'LIKE', '%' . $filter_parameter . '%')
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'date':
				$projects = StudentsProject::where('date',$filter_parameter)
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'school_name':
				$projects = StudentsProject::whereHas('school.user' , function($query) use ($filter_parameter) {
   					$query->where('name', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
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

		return response()->json(['posts'=>$projects]);
	}

	public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
	{
		$projects = array();
		switch ($suggest_type) 
		{
			case 'project_name':
				$projects_query = StudentsProject::where('name','LIKE','%'.$suggest_parameter.'%')
				->groupBy('name')
				->distinct()
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();

				foreach ($projects_query as $key => $pq)
				{
					array_push($projects, $pq->name);
				}
				break;

			case 'project_participant':
				$projects_query = StudentsProject::whereHas('schoolStudents' , function($query) use ($suggest_parameter) {
   					$query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
				})
				->distinct()
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				//iterate over the projects
				foreach ($projects_query as $key => $pq)
				{
					//iterate over the school students
					foreach ($pq->schoolStudents as $key => $school_student) 
					{
						//check if the student is same as the one searched for
						if (strpos($school_student->name, $suggest_parameter) !== false || strpos($school_student, $suggest_parameter) !== false )
						{
							if( !in_array($school_student->name, $projects))
							{
								array_push($projects, $school_student->name);
							}
						}
					}
					
				}
				break;

			case 'category':
				$projects_query = StudentsProject::where('category', 'LIKE', '%' . $suggest_parameter . '%')
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();

				foreach ($projects_query as $key => $pq)
				{
					//iterate over the school students
					$category = $pq->category;
					
						//check if the student is same as the one searched for
						if (strpos($category, $suggest_parameter) !== false && !in_array($category, $projects))
						{
							array_push($projects, $category);
						}	
				}
				break;

			case 'school_name':
				$projects_query = StudentsProject::whereHas('school.user' , function($query) use ($suggest_parameter) {
   					$query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->groupBy('name')->distinct();
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudents')
				->with('school.user')
				->with('images')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();

				foreach ($projects_query as $key => $pq)
				{
					//iterate over the school students
					$name = $pq->school->user->first()->name;
					
						//check if the student is same as the one searched for
						if (strpos($name, $suggest_parameter) !== false && !in_array($name, $projects))
						{
							array_push($projects, $name);
						}
					
					
				}
				break;
			
			default:
				# code...
				break;
		}

			return response()->json(['posts'=>$projects]);

	}


	public function deleteStudentProject($studentProjectId)
    {
        $student_project = StudentsProject::where('id',$studentProjectId)->first();
        $images = $student_project->images;
        $student_project_map = StudentsStudentsProject::where('students_project_id',$studentProjectId)->get();
        $comments = Comment::where('commentable_id',$studentProjectId)->where('commentable_type','App\StudentProject')->get();
        if ($student_project->delete())
        {
            #use helper to delete bursary image
            \Imagery::deleteImage($images);

            $likes = Like::where('likeable_id',$studentProjectId)->where('likeable_type','App\StudentProject')->get();
            foreach($comments as $comment) //deletes each image on the database
            {
                $comment->delete();
            }

            foreach($likes as $like)
            {
                $like->delete();
            }

            foreach ($student_project_map as $key => $map) 
            {
            	$map->delete();
            }
        }
        
        return response()->json([
        	'message'=>"successfully deleted post"
        ]);
    }


     public function index(User $user)
    {
    	$student_projects =$user->usable->studentProjects()
			->orderBy('created_at', 'desc')
			->paginate(5)
			->all();
            return response()->json(['user' => $user,'posts1'=>array_values($student_projects)]);
    }
}