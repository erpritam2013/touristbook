<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        dd('here');
    }
    public function commentStore(Request $request)
    {

          return response()->json(['message'=>'Your review has been submitted Successfully','auth' => true],200);
       
        if (!Auth::check()) {
             return response()->json([
                    'auth' => false,
                    'message' => 'Unauthorized error!'
            ],401);
        }
        $user_id = Auth::user()->id;
        $existed_comment = Comment::where('user_id',$user_id)->orWhere('email',$request->email)->where('model_id',$request->model_id)->first();
        if (!empty($existed_comment)) {
             return response()->json(['message'=>'You are reviewed already!','auth' => true,'already_existed' => true
            ],200);
        }
        
        $comment = new Comment();
        $comment->model_id = $request->model_id;
        $comment->name = $request->comment_name;
        $comment->email = $request->comment_email;
        $comment->comments= $request->comment;
        $comment->star_rating = $request->comment_rating;
        $comment->ip =  $request->comment_ip;
        $comment->agent = $request->comment_agent;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $comments = Comment::orderBy('created_at','DESC')->where('user_id',$user_id)->orWhere('email',$request->email)->where('model_id',$request->model_id)->take(5)->get(['id','name','email','star_rating','comments']);
        return response()->json(['message'=>'Your review has been submitted Successfully','auth' => true,'result'=>$comments],200);
    }
}
