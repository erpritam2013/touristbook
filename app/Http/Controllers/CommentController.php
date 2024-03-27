<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\DataTables\CommentDataTable;
use Session;
class CommentController extends Controller
{

    public function index(CommentDataTable $dataTable)
    {
        $data['title'] = 'Comments';
        $data['comments'] = Comment::count();

        return $dataTable->render('admin.comments.index',$data);
    }

    public function show($id)
    {
     $comment = Comment::findOrFail($id);
     if (!$comment) {
         abort(404);
     }
     $data['title'] = 'Comment';
     $data['comment'] = $comment;
     return view('admin.comments.show',$data);

 }


 public function loadComment(Request $request)
 {
     $start = $request->input('start');
     $model_id = $request->input('model_id');
     $model = $request->input('model_type');

     $data = Comment::orderBy('created_at', 'DESC')
     ->where('model_id',$model_id)
     ->where('model_type',$model)
     ->offset($start)
     ->limit(5)
     ->get();

     return response()->json([
        'data' => $data,
        'next' => $start + 5
    ]);
 }
 public function commentStore(Request $request)
 {

          // return response()->json(['message'=>'Your review has been submitted Successfully','auth' => true],200);

    if (!Auth::check()) {
     return response()->json([
        'auth' => false,
        'message' => 'Unauthorized error!'
    ],401);
 }
 $user_id = Auth::user()->id;
 $existed_comment = Comment::query();
 $existed_comment->where('user_id',$user_id)->where('model_id',$request->model_id)->where('model_type',$request->model_type);
 if (empty($existed_comment->first())) {

     $existed_comment->where('email',$request->email)->where('model_id',$request->model_id)->where('model_type',$request->model_type);
 }
 $ex_comment = $existed_comment->first();

 if (!empty($ex_comment)) {
     return response()->json(['message'=>'This User already reviewed!','auth' => true,'already_existed' => true
 ],200);
 }

 $comment = new Comment();
 $comment->model_id = $request->model_id;
 $comment->model_type = $request->model_type;
 $comment->name = $request->name;
 $comment->email = $request->email;
 $comment->comments= $request->review;
 $comment->star_rating = $request->rating;
 $comment->ip =  $request->comment_ip;
 $comment->agent = $request->comment_agent;
 $comment->comment_type = (!empty($request->comment_type))?$request->comment_type:'comment';
 $comment->user_id = Auth::user()->id;
 $comment->save();
 $result = [];
 $result['name'] = (!empty($comment->name))?$comment->name:$comment->user->name;
 $result['star_rating'] = $comment->star_rating;
 $result['comments'] = $comment->comments;
        // $comments = Comment::orderBy('created_at','DESC')->where('user_id',$user_id)->orWhere('email',$request->email)->where('model_id',$request->model_id)->select(['id','name','email','star_rating','comments'])->paginate(5);
 return response()->json(['message'=>'Your review has been submitted Successfully','auth' => true,'result'=>$result,'status'=>true],200);
}

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (!$comment) {
            abort(404);
        }
        $comment->delete();
        Session::flash('success','Comment Deleted Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $commentIds = get_array_mapping(json_decode($request->ids));
          Comment::whereIn('id', $commentIds)->delete();
          Session::flash('success', 'Comment Bulk Deleted Successfully');
      }
      return back();
  }
}
