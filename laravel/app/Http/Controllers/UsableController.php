<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsableController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $usable = $user->usable_type::where('_id',$user->usable_id)->project([
            #exclude embedded documents
            'activities' =>0,
            'bursaries' =>0,
            'events' =>0,
            'facilities' =>0,
            'featured_students' =>0,
            'needs' =>0,
            'needs_gratitude' =>0,
            'needs_overview' =>0,
            'staff' =>0,
            'student_awards' =>0,
            'student_projects' =>0,
            'students' =>0,
            'random stuff' =>0,
        ])
        ->first();

        $user = User::where('_id',$user->id)
        ->project([
            #fields to be excluded N.B 0 for exclusion and 1 for inclusion
            'posts'=>0,
            'usable'=>0,
            'settings'=>0
        ])
        ->first();
        
        return response()->json(['posts1'=>$usable]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
