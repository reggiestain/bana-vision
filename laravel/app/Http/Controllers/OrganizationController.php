<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['update','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }

    public function getOrganizationsPage(Request $request)
    {
        $organizations = Organization::with('user')->whereNotNull('id')->paginate(6);
        //the request is from ajax loading more data
        if ($request->ajax()) 
        {
            $organizations = Organization::with('user')
            ->whereNotNull('id')
            ->paginate(6,['*'],'page1',$_GET['page1'])
            ->getCollection();
            return response()->json(['posts'=>$organizations]);
        }
        return view('organization.organizationsPage',['organizations'=>$organizations->getCollection()]);
    }

    public function filterOrganization($filter_type,$filter_parameter)
    {
        $projects = null;
        switch ($filter_type) 
        {
            case 'focus':
                $organizations = Organization::where('focus',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'organization_type':
                $organizations = Organization::where('organization_type',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'registration_number':
                $organizations = Organization::where('registration_number',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'organization_name':
                $organizations = Organization::whereHas('user' , function($query) use ($filter_parameter) {
                    $query->where('name', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                
                break;


            case 'country':
                $organizations = Organization::where('headquarters_country',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'province':
                $organizations = Organization::where('headquarters_province',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'town':
                $organizations = Organization::where('headquarters_town',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            
            default:
                # code...
                break;
        }

        return response()->json(['posts'=>$organizations]);
    }

    /**
     * [This function auto suggests variables ]
     * @param  [type] $suggest_type      [description]
     * @param  [type] $suggest_parameter [description]
     * @return [type]                    [description]
     */
    public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
    {
        $organizations = array();
        switch ($suggest_type) 
        {
            
            case 'industry':
                $companies_query = Company::where('sector', 'LIKE', '%' . $suggest_parameter . '%')
               ->with('user')
                ->get();

                foreach ($companies_query as $key => $iq)
                {
                    //iterate over the school students
                    $industry = $iq->sector;
                    
                        //check if the student is same as the one searched for
                        if (strpos($industry, $suggest_parameter) !== false && !in_array($industry, $companies))
                        {
                            array_push($companies, $industry);
                        }   
                }
                break;

            case 'registration_number':
                $organizations_query = Organization::where('registration_number', 'LIKE', '%' . $suggest_parameter . '%')
               ->with('user')
                ->get();

                foreach ($organizations_query as $key => $cq)
                {
                    //iterate over the school students
                    $registration_number = $cq->registration_number;
                    
                        //check if the student is same as the one searched for
                        if (strpos($registration_number, $suggest_parameter) !== false && !in_array($registration_number, $organizations))
                        {
                            array_push($organizations, $registration_number);
                        }   
                }
                break;

            case 'organization_name':
                $organizations_query = Organization::whereHas('user' , function($query) use ($suggest_parameter) {
                    $query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->groupBy('name')->distinct();
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();

                foreach ($organizations_query as $key => $oq)
                {
                    //iterate over the school students
                    $name = $oq->user->first()->name;
                    
                        //check if the company is same as the one searched for
                        if (strpos($name, $suggest_parameter) !== false && !in_array($name, $organizations))
                        {
                            array_push($organizations, $name);
                        }
                    
                    
                }
                break;
            
            default:
                # code...
                break;
        }

            return response()->json(['posts'=>$organizations]);

    }
}
