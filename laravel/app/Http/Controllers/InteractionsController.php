<?php

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use App\Like;
use App\Reply;
//use App\Share;
use Illuminate\Http\Request;

class InteractionsController extends Controller
{
    public function deleteComment($commentIdNo)
    {
    	$comment = Comment::where('id',$commentIdNo)->first();
    	$comment->delete();
 		return redirect()->back()->with(['message'=>'your comment has been deleted']);
    }
}
