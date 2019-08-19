<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\ChallengeTag;
use App\Challenge;

class TagController extends Controller
{

    //public function attachTag($tagable_ty)

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "hello";
        return UtilityController::generalResponse("success", Tag::all());
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
        //return array('status'=>"success", 'data'=>"hello");
        
        //return array("status"=>"success", "data"=>"hello";
        $inTag = json_decode($request->input("data"));
        if(!$inTag) return UtilityController::GeneralResponse("failed", 'data not well formated or empty');
        $tag = new Tag;
        $tag->title = $inTag->title;
        $tag->description = $inTag->description;
        
        $tag->save(); 

        //$tag = Tag::find(1);

        //$tags = array($tag, $tag, $tag, $tag, $tag, $tag);

        return UtilityController::generalResponse("success",$tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UtilityController::generalResponse("success", Tag::find($id));
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
        $inTag = json_decode($request->input("data"));
        if(!$inTag) return UtilityController::GeneralResponse("failed", 'data not well formated or empty');
        $tag = Tag::find($id);
        $tag->title = $inTag->title;
        $tag->description = $inTag->description;

        $tag->save();

        //return array("status"=>"success", "data"=>$tag);
        return UtilityController::generalResponse("success", $tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request, $id) {
        $inTag = json_decode($request->input("data"));
        $tag = Tag::find($id);
        if($tag) {
            $tag->delete();
            return UtilityController::GeneralResponse("success", "tag deleted successfully");
        } else {
            return UtilityController::GeneralResponse("failed", "tag does not already exixt");
        }
    }
    
    public function destroy($id)
    {
        
    }


    public function testAttachTags() {
        $tags = Tag::all()->take(5);
        
        TagController::attachTagsToChallenge($tags, 3);
    }

    public static function attachTagsToChallenge($tags, $challengeId) {
        
        $challenge = Challenge::find($challengeId);
        if ($challenge) {
            foreach ($tags as $t) {
                $tag = TagController::getOrInsert($t->title);
                 
                $ct = new ChallengeTag;
                $ct->tag_id = $tag->id;
                $ct->challenge_id = $challengeId;
                $ct->save();
                //return true;
            }
        }
    }


    public static function getOrInsert($tagTitle) {
        //return true;
        $tag = Tag::where([["title", "=", $tagTitle]])->get()->first();
        if ($tag) {
            return $tag;
        } else {
            $tag = new Tag;
            $tag->title = $tagTitle;
            $tag->description = $tagTitle." Description";
            $tag->save();
            return $tag;
        }
    }

    public function search(Request $request) {
        $query = json_decode($request->input('data'));

        $tags = Tag::where([["title", "LIKE", "%$query%"]])->get(['title', 'id'])->take(20);

        //return "Hello";
        return UtilityController::GeneralResponse("success", $tags);

    }
}
