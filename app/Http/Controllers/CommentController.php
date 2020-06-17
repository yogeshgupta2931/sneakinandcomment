<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Like;
use App\User;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comments = Comment::with(['user','likes'])->withCount('likes')->orderBy('created_at')->get()->toArray();
        return view('comments.index', ['comments'=>$comments]);
    }

    public function likeComment(Request $request) 
    {
        $comment_id = $request->comment_id;
        $commentObj = Comment::where('id', $comment_id)->with('likes')->withCount('likes')->first();
        
        if ( !empty($commentObj) ) {
            $like = Like::withTrashed()->updateOrCreate(
                ['comment_id' => $comment_id, 'user_id' => \Auth::id()],
                ['deleted_at' => null]
            );

            if ( !empty($like->id) ) {
                if ( $commentObj->likes_count > 0 ) {
                    $html = "<i class='fas fa-thumbs-up' title=\"You and ". ($commentObj->likes_count) ." other liked this comment\"></i>&nbsp;". ($commentObj->likes_count + 1);
                } else {
                    $html = "<i class='fas fa-thumbs-up' title=\"You liked this comment\"></i>&nbsp;". ($commentObj->likes_count + 1);
                }
                return response()->json(['message' => 'liked comment', 'html' => $html], 200);
            }
        }
        return response()->json(['message'=>'not able to like comment'], 204);
    }

    public function save(CreateCommentRequest $request) 
    {
        $commentObj = new Comment;
        $commentObj->user_id = \Auth::id();
        $commentObj->comment = $request->comment;
        $commentObj->save();
        return redirect()->route('comments.list');
    }

    public function delete(Request $request) 
    {
        $comment_id = $request->comment_id;
        $commentObj = Comment::where('id', $comment_id)
                            ->where('user_id', \Auth::id())
                            ->first();
        
        if ( !empty($commentObj) ) {
            $commentObj->delete();
            return response()->json(['message' => 'Comment is deleted'], 200);
        }

        return response()->json(['message' => 'Can\'t delete'], 204);
    }

}