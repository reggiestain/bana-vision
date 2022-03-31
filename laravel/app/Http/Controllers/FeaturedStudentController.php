<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\FeaturedStudent;
use App\Comment;
use App\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FeaturedStudentController extends Controller
{
    
    //GET THE SCHOOLPAGE
	public function getGeneralFeaturedStudentsPage(Request $request)
	{
		$featured_students = FeaturedStudent::latest()->limit(40)
		->orderBy('created_at', 'desc')
		->with('school.user')
		->with('schoolStudent.images')
		->withCount('comments')
		->withCount('likes')
		->withCount('shares')
		->with('schoolStudent')
		->paginate(5)
		->setPageName('page1');
		//the request is from ajax loading more data
		if ($request->ajax()) 
		{
    		$featured_students = FeaturedStudent::latest()
    		->orderBy('created_at', 'desc')
    		->with('school.user')
    		->with('schoolStudent.images')
    		->withCount('comments')
    		->withCount('likes')
			->withCount('shares')
			->with('schoolStudent')
			->paginate(5,['*'],'page1',$_GET['page1'])
			->getCollection();
            return response()->json([
            	'posts'=>$featured_students
            ]);
        }
		return view('student.featured.generalFeaturedStudentsPage',[
			'posts'=>$featured_students->getCollection()
		]);
	}

	public function getFeaturedStudentsPage(User $user)
	{
		return view('student.featured.featuredStudentsPage',['userIdNo' => $user]);
	}
	
		public function filterStudentFeatured($filter_type,$filter_parameter)
	{
		$featureds = null;
		switch ($filter_type) 
		{
			case 'country':
				$featureds = FeaturedStudent::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
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
				$featureds = FeaturedStudent::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
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
				$featureds = FeaturedStudent::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('town', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('schoolStudent')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'suburb':
				$featureds = FeaturedStudent::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('suburb', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('schoolStudent')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'featured_student_name':
				$featureds = FeaturedStudent::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('name', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('schoolStudent')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'k_12':
				$featureds = FeaturedStudent::whereHas('school' , function($query) use ($filter_parameter) {
   					$query->where('k_12', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('schoolStudent')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'major':
				$featureds = FeaturedStudent::whereHas('schoolStudent.school' , function($query) use ($filter_parameter) {
   					$query->where('major', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('schoolStudent')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'gender':
				$featureds = FeaturedStudent::whereHas('schoolStudent' , function($query) use ($filter_parameter) {
   					$query->where('gender', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('schoolStudent')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;

			case 'school_name':
				$featureds = FeaturedStudent::whereHas('schoolStudent.school.user' , function($query) use ($filter_parameter) {
   					$query->where('name', 'LIKE', '%' . $filter_parameter . '%');
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.images')
				->with('school.user')
				->withCount('comments')
				->withCount('likes')
				->withCount('shares')
				->get();
				break;
			
			default:
				# code...
				break;
		}

		return response()->json(['posts'=>$featureds]);
	}

	public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
	{
		$featureds = array();
		switch ($suggest_type) 
		{

			case 'featured_student_name':
				$featureds_query = FeaturedStudent::whereHas('schoolStudent' , function($query) use ($suggest_parameter) {
   					$query->where('name', 'like', '%' . $suggest_parameter . '%');
				})
				->distinct()
				->with('schoolStudent')
				->orderBy('created_at', 'desc')
				->get();
				//iterate over the projects
				foreach ($featureds_query as $key => $fq)
				{
					$school_student = $fq->schoolStudent;
						//check if the student is same as the one searched for
						if (strpos($school_student->name, $suggest_parameter) !== false || strpos($school_student->name, $suggest_parameter) !== false )
						{
							if( !in_array($school_student->name, $featureds))
							{
								array_push($featureds, $school_student->name);
							}
						}
					
				}
				break;

			case 'major':
				$featureds_query = FeaturedStudent::whereHas('schoolStudent' , function($query) use ($suggest_parameter) {
   					$query->where('major', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->get();

				foreach ($featureds_query as $key => $fq)
				{
					//iterate over the school students
					$major = $fq->schoolStudent->major;
					
						//check if the student is same as the one searched for
						if (strpos($major, $suggest_parameter) !== false && !in_array($major, $featureds))
						{
							array_push($featureds, $major);
						}	
				}
				break;

			case 'school_name':
				$featureds_query = FeaturedStudent::whereHas('schoolStudent.school.user' , function($query) use ($suggest_parameter) {
   					$query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->groupBy('name')->distinct();
				})
				->limit(25)
				->orderBy('created_at', 'desc')
				->with('schoolStudent.school.user')
				->get();

				foreach ($featureds_query as $key => $fq)
				{
					//iterate over the school students
					$name = $fq->schoolStudent->school->user->first()->name;
					
						//check if the student is same as the one searched for
						if (strpos($name, $suggest_parameter) !== false && !in_array($name, $featureds))
						{
							array_push($featureds, $name);
						}
					
					
				}
				break;
			
			default:
				# code...
				break;
		}

			return response()->json(['posts'=>$featureds]);

	}

	public function deleteFeaturedStudent($featuredStudentId)
    {
        $featured_student = FeaturedStudent::where('id',$featuredStudentId)->first();
        $comments = Comment::where('commentable_id',$featuredStudentId)->where('commentable_type','App\FeaturedStudent')->get();
        if ($featured_student->delete())
        {
            $likes = Like::where('likeable_id',$featuredStudentId)->where('likeable_type','App\FeaturedStudent')->get();
            foreach($comments as $comment) //deletes each image on the database
            {
                $comment->delete();
            }

            foreach($likes as $like)
            {
                $like->delete();
            }
        }
        
        return response()->json([
        	'message'=>"successfully deleted post"
        ]);
    }

    public function index(User $user)
    {
    	$featured_students =$user->usable->featuredStudents()
			->orderBy('created_at', 'desc')
			->paginate(5)
			->all();
            return response()->json(['user' => $user,'posts1'=>array_values($featured_students)]);
    }
   
}