<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\School;
//use App\Exports\UsersExport;


class UpdateInformationController extends Controller
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        ini_set('memory_limit', '512M');
        /*Excel::import(new UsersImport,'north_west.xlsx');
        Excel::import(new UsersImport,'free_state.xlsx');
        Excel::import(new UsersImport,'northern_cape.xlsx');
        Excel::import(new UsersImport,'western_cape.xlsx');*/
        Excel::import(new UsersImport,'kwa_zulu_natal.xlsx');
        /*Excel::import(new UsersImport,'gauteng.xlsx');
        Excel::import(new UsersImport,'limpopo.xlsx');
        Excel::import(new UsersImport,'mpumalanga.xlsx');
        Excel::import(new UsersImport,'eastern_cape.xlsx');*/

        return response('Hello World', 200)->header('Content-Type', 'text/plain');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    } */

    public function add_user_to_school()
    {
        $schools = School::all();
        foreach($schools as $school)
        {
            $school->is_one_of_first_schools = true;
            $school->update();
        }
    }
}
