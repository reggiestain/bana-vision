<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function getCompaniesPage(Request $request)
    {
        $companies = Company::with('user')->whereNotNull('id')->paginate(6);
        //the request is from ajax loading more data
        if ($request->ajax()) 
        {
            $companies = Company::with('user')
            ->whereNotNull('id')
            ->paginate(6,['*'],'page1',$_GET['page1'])
            ->getCollection();
            return response()->json(['posts'=>$companies]);
        }
        return view('company.companiesPage',['companies'=>$companies->getCollection()]);
    }









        public function filterCompany($filter_type,$filter_parameter)
    {
        $projects = null;
        switch ($filter_type) 
        {
            case 'business_entity':
                $companies = Company::where('business_entity',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'industry':
                $companies = Company::where('sector',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'registration_number':
                $companies = Company::where('registration_number',$filter_parameter)
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                break;

            case 'company_name':
                $companies = Company::whereHas('user' , function($query) use ($filter_parameter) {
                    $query->where('name', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
                
                break;
            
            default:
                # code...
                break;
        }

        return response()->json(['posts'=>$companies]);
    }

    /**
     * [This function auto suggests variables ]
     * @param  [type] $suggest_type      [description]
     * @param  [type] $suggest_parameter [description]
     * @return [type]                    [description]
     */
    public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
    {
        $companies = array();
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
                $companies_query = Company::where('registration_number', 'LIKE', '%' . $suggest_parameter . '%')
               ->with('user')
                ->get();

                foreach ($companies_query as $key => $cq)
                {
                    //iterate over the school students
                    $registration_number = $cq->registration_number;
                    
                        //check if the student is same as the one searched for
                        if (strpos($registration_number, $suggest_parameter) !== false && !in_array($registration_number, $companies))
                        {
                            array_push($companies, $registration_number);
                        }   
                }
                break;

            case 'company_name':
                $companies_query = Company::whereHas('user' , function($query) use ($suggest_parameter) {
                    $query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->groupBy('name')->distinct();
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();

                foreach ($companies_query as $key => $cq)
                {
                    //iterate over the school students
                    $name = $cq->user->first()->name;
                    
                        //check if the company is same as the one searched for
                        if (strpos($name, $suggest_parameter) !== false && !in_array($name, $companies))
                        {
                            array_push($companies, $name);
                        }
                    
                    
                }
                break;
            
            default:
                # code...
                break;
        }

            return response()->json(['posts'=>$companies]);

    }
}
