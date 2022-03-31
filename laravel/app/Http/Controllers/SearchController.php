<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OurEvent;
use App\Bursary;
use App\User;
use App\OurNeed;
use Illuminate\Support\Collection;
use App\School;

class SearchController extends Controller
{
  /*********************************************************************
  *   SEARCH RESULTS
  **********************************************************************
  *
  *@params request
  *@return view
  */
  public function search(Request $request, $query_type = null)
  { 
    
    /*$this->validate($request,[
      'query'=>'required|min:3'
    ]);*/


    $searchResults = array();

    $rq = $request['query'];
    
    if($request->has('query_type'))
    {
      switch($request['query_type'])
      {
      case 'OurEvent': //Appends events to the search results
      $results = $this->events();
      break;

      case 'Bursary': //Appends bursaries to the search results
      $results = $this->bursary();
      break;

      case 'OurNeed': //Appends needs to the search results
      $results = $this->need();
      break;

      case 'School'://Appends institutions to the search results
      /*$results = School::whereHas('user' , function($query) use ($rq) {
        $query->where('name', 'LIKE', '%' . $rq . '%')->get();
      })
                //->orderBy('created_at', 'desc')
      ->with('user')
      ->limit(25)
      ->get();*/

      break;
      break;
      default:
    }
  }
    else
    {
      $results = User::where('name', 'LIKE', '%' . $rq . '%')->limit(25)->get();
    }
    


    

    
    //if($request['search_events'] != '0')


    foreach ($results as $key => $result) 
      {
        array_push($searchResults,$result);
      }
      return response()->json(['posts1'=>array_values($searchResults)]);
    
    //$usernames = User::where('name','LIKE','%'.$query.'%')->get();
     // $schools = School::where('suburb','LIKE','%'.$query.'%')->orWhere('province','LIKE','%'.$query.'%')->orWhere('district','LIKE','%'.$query.'%')->orWhere('k_12','LIKE','%'.$query.'%')->orWhere('coeducational','LIKE','%'.$query.'%')->orWhere('funding ','LIKE','%'.$query.'%')->orWhere('special_needs','LIKE','%'.$query.'%')->get();

    //$searchResults = $searchResults->merge($usernames);
                //$searchResults = $usernames->map(function($username,$key){
                //  return $username;
                //});
  }


  public function name($query,$query_type)
  {
    //$object = & call_user_func(array($class,'getInstance'), $param1, $param2 );
    //dd(new "\\App\\".$query_type);
    dd(User);
    //$user_obj = & call_user_func(array($query_type,'where'), $param1, $param2 );
    //$user_obj = User::where('name','LIKE','%'.$query.'%');
    dd(///return User::where('name','LIKE','%'.$query.'%')
          $user_obj->orWhere('description','LIKE','%'.$query.'%')
          ->latest()
          ->limit(35)
          ->get());
  }

  public function bursary()
  {
    return Bursary::where('title','LIKE','%'.$query.'%')
      ->orWhere('description','LIKE','%'.$query.'%')
      ->distinct()
      ->latest()
      ->limit(35)
      ->get();
  }

  public function description()
  {

  }

  public function need()
  {
    return OurNeed::where('title','LIKE','%'.$query.'%')
      ->orWhere('description','LIKE','%'.$query.'%')
      ->latest()
      ->limit(35)
      ->get();
  }

  public function institution()
  {
     return $results = User::where('usable_type','App\School')
      ->where('name','LIKE','%'.$query.'%')
      ->limit(35)
      ->get();

      $results_ = School::where('suburb','LIKE','%'.$query.'%')
      ->orWhere('province','LIKE','%'.$query.'%')
      ->orWhere('district','LIKE','%'.$query.'%')
      ->orWhere('about','LIKE','%'.$query.'%')
      ->orWhere('history','LIKE','%'.$query.'%')
      ->limit(35)
      ->get();
  }
}


