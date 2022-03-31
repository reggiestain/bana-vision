<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Note;
use App\NoteExplanation;

class NotesController extends Controller
{
    public function getNotesPage(User $user)
    {
    	$notes = Note::where('user_id',$user->id)->get();
    	return view('student.note.myNotesPage',['userIdNo'=>$user,'notes'=>$notes]);
    }

    public function createExplanation(Request $request)
    {
    	$this->validate($request,[
    		'highlight_start'=>'required|numeric',
    		'highlight_end'=> 'required|numeric',
    		'note_id'=> 'required|numeric',
    		'body'=>'required|string',
    		'explanation_url'=>'url'
    	]);

    	$explanation = new NoteExplanation();
    	$explanation->highlight_start = $request['highlight_start'];
    	$explanation->highlight_end = $request['highlight_end'];
    	$explanation->note_id = $request['note_id'];
    	$explanation->body = $request['body'];
    	$explanation->explanation_url = $request['explanation_url'];
    	$explanation->user_id = \Auth::id();
    	$explanation->save();
    	return redirect()->back()->with(['message'=>"your explanation has been saved"]);
    }
}
