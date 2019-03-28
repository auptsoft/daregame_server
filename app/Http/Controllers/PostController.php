<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::paginate();
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
        $postIn = json_encode($request->input('data'));
        if($postIn) {
            $post = new Post;
            $post->user_id = $postIn->user_id;
            $post->title = $postIn->title;
            $post->content = $postIn->content;
            $post->save();

            UtilityController::GeneralResponse('success', $post);
        } else {
            UtilityController::GeneralResponse('failed', 'data not well formated');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::find($id);
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
        $postIn = json_encode($request->input('data'));
        if($postIn) {
            $post = Post::find($id);
            $post->user_id = $postIn->user_id;
            $post->title = $postIn->title;
            $post->content = $postIn->content;
            $post->save();

            UtilityController::GeneralResponse('success', $post);
        } else {
            UtilityController::GeneralResponse('failed', 'data not well formated');
        }
    }

    public function delete($id) {
        $post = Post::find($id);
        if($post) {
            $post->delete();
            return UtilityController::GeneralResponse('success', 'post deleted successfully');
        } else {
            return UtilityController::GeneralResponse('failed', 'post does not exist');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where("id", $id)->get()-first();
        if($post) {
             $post->forceDelete();
        } else {
            UtilityController::generalResponse("failed", "challenged does not exist or already force deleted");
        }
    }


    /*public function addComment($id, Request $request) {
        $challenge = Post::find($id);

        CommentController::addComment('post', $id, $request);
    } */

    public function attachTags($post_id, Request $request) {
        $tags = json_decode($request->input('data'));
        if ($tags) {
            foreach($tags as $tag) {
                $pt = new Post_Tag;
                $pt->post_id = $post_id;
                $pt->tag_id = $tag->id;
                $pt->save();
            }
            return UtilityController::GeneralResponse("success", "tags added successfully");
        } else {
            return UtilityController::GeneralResponse("success", "data not well formated");
        }
    }

    public function detachTags($post_id, Request $request) {
        $tags = json_decode($request->input('data'));
        if($tags) {
            foreach($tags as $tag){
                $ct = Challenge_Tag::where(
                    [
                        ['tag_id', '=', $tag_id],
                        ['post_id', '=', $post_id]
                    ]
                )->get()->first();
                if($ct){
                    $ct->delete();
                }
            } 
            return UtilityController::GeneralResponse('success', 'tags removed successfully');
        } else {
            return UtilityController::GeneralResponse('failed', "data not well formated");
        }
    }

    public function getTags($post_id) {
        return Post::find($challenge_id)->tags();
    }
}