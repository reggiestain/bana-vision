<?php

namespace App\Imports;

use App\User;
use App\School;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Http\Request;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $request = new Request();

            $request->merge(
                [
                    "user"=>[
                        'name'=>$row['institution_name'], 
                        'email'=>"none provided", 
                        'password'=> substr(md5(microtime()), 0, 10), // secret
                    ],
                    "Party"=>"School"
            ]); # add user

            $request->merge(["School"=>[
        'web_url'=>"",
        'about'=>"",
        'history'=>"",
        'principal'=>"",
        'number_students'=>"",
        'number_teachers'=>"",
        'country'=>"za",
        'suburb'=>$row['suburb'],
        'province'=>$row['province'],
        'district'=>"",//ok
        'coeducational'=>"",
        'pass_rate'=>"",
        'special_needs'=>"",
        'telephone'=>$row['telephone'],
        'k_12'=>"",
        'sector'=>$row['sector'],
        'bana_email_address'=>"",
        'bana_email_password'=>"",
        'natEmis'=>$row['natemis'], 
        'province_cd'=>$row['provincecd'],      
        'status'  =>$row['status'],
        'type_ped'  =>$row['type_ped'], 
        'phase_ped'  =>$row['phase_ped'],
        'specialization'  =>$row['specialization'],
        'owner_land'=>$row['ownerland'],   
        'owner_buildings'=>$row['ownerbuildings'],  
        'ex_dept'=>$row['exdept'],  
        'pay_point_no'=>$row['paypointno'],  
        'component_no'=>$row['componentno'], 
        'exam_no'=>$row['examno'],  
        'exam_centre'=>$row['examcentre'],  
        'new_lat'=>$row['new_lat'], 
        'new_long'=>$row['new_long'],    
        'gis_source'=>$row['gissource'],   
        'district_municipality_name'=>$row['districtmunicipalityname'],    
        'local_municipality_name'=>$row['local_municipalityname'],  
        'ward_id'=>$row['ward_id'], 
        'sp_code'=>$row['sp_code'], 
        'sp_name' =>$row['sp_name'],
        'ei_district'=>$row['eidistrict'],  
        'ei_circuit'=>$row['eicircuit'],   
        'addressee'=>$row['addressee'],   
        'township_village'=>$row['township_village'],    
        'town_city'=>$row['towncity'],    
        'street_address'=>$row['streetaddress'],   
        'postal_address'=>$row['postaladdress'],   
        'section21'=>$row['section21'],   
        'section21_funct'=>$row['section21_funct'], 
        'quintile'=>$row['quintile'],    
        'nas'=>$row['nas'], 
        'nodal_area'=>$row['nodalarea'],   
        'registration_date'=>$row['registrationdate'],    
        'no_fee_school'=>$row['nofeeschool'], 
        'allocation'=>$row['allocation'],  
        'demarcation_from'=>$row['demarcationfrom'], 
        'demarcation_to'=>$row['demarcationto'],   
        'old_nat_emis'=>$row['oldnatemis'],  
        'new_nat_emis'=>$row['newnatemis'],


            ]]); # add school

            app('App\Http\Controllers\Auth\RegisterController')->postCreateStepFinal($request); #add data to database
            /*User::create([
                'name' => $row[0],
            ]);*/
        }
    }
     public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}
