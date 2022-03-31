<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NeedsGratitudeController extends Controller
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
    public function index(User $user,Request $request)
    {
        if($user->usable_type == 'App\School')
        {
            $needs_gratitude =$user->usable->needs_gratitude()
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->all();

            $userIdNumber = $user;
            return response()->json(['user' => $userIdNumber,'posts2'=>array_values($needs_gratitude)]);
        }
        else
        {
            return response()->json(['message'=>"only schools have this function"]);
        }
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
    public function show($id)
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
