<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request) {
        
        $commentIn = json_decode($request->input('data'));
        
        $comment = new Comment;
        
        if($commentIn) {
            $comment->user_id = $commentIn->user_id;
            $comment->title = $commentIn->title;
            $comment->content = $commentIn->content;
            $comment->commentable_type = $commentIn->commentable_type;
            $comment->commentable_id = $commentIn->commentable_id;
            $comment->save();
//return UtilityController::GeneralResponse("failed", array('data'=>"error"));
            return UtilityController::GeneralResponse("success", $comment);
        } else {
            return UtilityController::GeneralResponse("failed", "data not well formated or empty");
        }
    }

    public function removeComment($comment_id) {
        $comment = Comment::find($comment_id);
        if($comment) {
            $comment->delete();
            return UtilityController::GeneralResponse("success", "Comment deleted successfully");
        } else {
            return UtilityController::GeneralResponse("failed", "comment not found");
        }
    }

    public function getComments($commenatable_type, $commentable_id) {
        $comments = DB::table('comments')->where(
            [
                ["commentable_type", "=", $commenatable_type],
                ["deleted_at", "=", null]
            ])->paginate();

        return $comments;
    }
}