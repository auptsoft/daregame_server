<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Challenge;
use App\ChallengeTag;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Challenge::paginate();
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
        try {
            $data = json_decode($request->input("data"));

            if ($data) {
               $challenge = new Challenge;
               $challenge->challenger_id = $data->challenger_id;
               $challenge->challenged_id = $data->challenged_id;
               $challenge->description = $data->description;
               $challenge->price = $data->price;
               $challenge->accept_type = $data->accept_type;
               $challenge->accepted_at = $data->accepted_at;
               $challenge->performed_at = $data->performed_at;
               $challenge->category_id = $data->category_id;
               $challenge->max_acceptance_at = $data->max_acceptance_at;

               $challenge->save();

               return UtilityController::generalResponse("success", $challenge);
            } else {
                return UtilityController::generalResponse("failed", "data not well formated");
            }

        } catch(Exception $e) {
            //$reponse = array("status"=>$e->getMessage(), "data"=>"");
            return UtilityController::generalResponse("failed", $e->getMessage());
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
        return UtilityController::generalResponse("success", App\Challenge::find($id));
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
        try {
            //$data = json_decode($request->input('data'));
            $data = json_decode($request->input("data"));
            //return $request;
            if ($data) {
               $challenge = Challenge::find($id);
               if (!$challenge) return UtilityController::GeneralResponse("failed", 'challenge does not already exist');
               $challenge->challenger_id = $data->challenger_id;
               $challenge->challenged_id = $data->challenged_id;
               $challenge->description = $data->description;
               $challenge->price = $data->price;
               $challenge->accept_type = $data->accept_type;
               $challenge->accepted_at = $data->accepted_at;
               $challenge->performed_at = $data->performed_at;
               $challenge->category_id = $data->category_id;
               $challenge->max_acceptance_at = $data->max_acceptance_at;

               $challenge->save();

               return UtilityController::generalResponse("success", $challenge);
            } else {
                return UtilityController::generalResponse("failed", "data not well formated");
            }
        } catch(Exception $e) {
            //$reponse = array("status"=>$e->getMessage(), "data"=>"");
            return UtilityController::generalResponse("failed", $e->getMessage());
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $model = Challenge::find($id);
        if($model) {
            $model->delete();
            return UtilityController::generalResponse("success", "deleted successfully");
        } else {
            UtilityController::generalResponse("failed", "challenged does not exist or already deleted");
        }
        
    }
    
    public function destroy($id)
    {
        $challenge = Challenge::withTrashed()->where("id", $id)->get()-first();
        if($challenge) {
             $challenge->forceDelete();
        } else {
            UtilityController::generalResponse("failed", "challenged does not exist or already force deleted");
        }
       
    }

    public function deleted() {
        return UtilityController::generalResponse("success", Challenge::onlyTrashed()->get());
    }

    public function all() {
        return UtilityController::generalResponse("success", Challenge::withTrashed()->get());
    }

    /*public function addComment($id, Request $request) {
        $challenge = Challenge::find($id);

        CommentController::addComment("challenge", $id, $request);
    } */

    public function attachTags($challenge_id, Request $request) {
        $tags = json_decode($request->input('data'));
        if ($tags) {
            foreach($tags as $tag) {
                $ct = new ChallengeTag;
                $ct->challenge_id = $challenge_id;
                $ct->tag_id = $tag->id;
                $ct->save();
            }
            return UtilityController::GeneralResponse("success", "tags added successfully");
        } else {
            return UtilityController::GeneralResponse("success", "data not well formated");
        }
    }

    public function detachTags($challenge_id, Request $request) {
        //return $request->input('data');
        $result = array();
        $tags = json_decode($request->input('data'));
        if($tags) {
            foreach($tags as $tag){
                //return $tag->id;
                $ct = ChallengeTag::where(
                    [
                        ['tag_id', '=', $tag->id],
                        ['challenge_id', '=', $challenge_id]
                    ]
                )->get()->first();
                //return $ct;
                if($ct){
                    $ct->delete();
                    return array_push($result, $ct->id);
                }
            } 
            return UtilityController::GeneralResponse('success', $result);
        } else {
            return UtilityController::GeneralResponse('failed', "data not well formated");
        }
    }

    public function getTags($challenge_id) {
        return Challenge::find($challenge_id)->tags()->where('challenge_tag.deleted_at', null)->get();
    }

    public function search(Request $request) {
        $data = json_decode($request->input('data'));

        //return $data;
        $query = array();
        foreach ($data as $item) {
            array_push($query, array($item->column, $item->operator, $item->value));
        }

        //return $query;
        
        $challenge = Challenge::where($query)->get();
        return $challenge;
    }
}