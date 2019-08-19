<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use App\Media;
use App\Challenge;
use App\Post;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Media::paginate();
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
        //return ("hello");
        if ($request->hasFile('media_file')) {
            $data = json_decode($request->input("data"));
            
            
            $media = new Media;
            $media->owner_id = $data->owner_id;
            $media->owner_type = $data->owner_type;
            $media->type = $data->type;
            $media->file_name = $data->file_name;
            
            $name = $request->file('media_file')->getClientOriginalName();
            //$extension = $request->file('media_file')->getClientOriginalExtension();
            
            $path = $request->file('media_file')->storeAs("media/".$media->owner_type."/".$media->type, $media->file_name);
            $media->url = $path;
            
            $media->name = $name;
            
            $media->save(); 
            //return array('status'=>"success", 'data'=>"$media");
            return UtilityController::generalResponse("status", Media::find($media->id));
            //return array("status"=>"Success: $media->type uploaded", "data"=>Media::find($media->id));
            //return array("status"=>"success", "data"=>$name." data:".$data);
        } else {
            $reponse = array("status"=>"error: file not found", "data"=>"");
            return $reponse;
        } 

    }
	
	public function storeMedia(Request $request, $media) {
		if ($request->hasFile('media_file')) {
            $data = json_decode($request->input("data"));
			
			$name = $request->file('media_file')->getClientOriginalName();
            //$extension = $request->file('media_file')->getClientOriginalExtension();
            
            $path = $request->file('media_file')->storeAs("media/".$media->owner_type."/".$media->type, $media->file_name);
            
			$media->url = $path;
            $media->name = $name;
            
            $media->save(); 
            //return array('status'=>"success", 'data'=>"$media");
            return UtilityController::generalResponse("success", "uploaded challenge placed successfully");
            //return array("status"=>"Success: $media->type uploaded", "data"=>Media::find($media->id));
            //return array("status"=>"success", "data"=>$name." data:".$data);
        } else {
            return UtilityController::generalResponse("failed", "could not find media file");
        } 
	}

    public function simpleUpload(Request $request) {
        $name = $request->file('media_file')->store("media/android");
        $data = $request->input("data");
        return array("status"=>"success", "data"=>$name." data:".$data);
    }

    //returns array General Response of Media objects
    public function getMedia($owner, $id, $type) {
        switch ($owner) {
            case 'challenge':
                if ($type == "all") {
                    $media = Challenge::find($id)->media();
                    return UtilityController::generalResponse("success", $media);
                } else {
                    $media = Challenge::find($id)->media()->where('type', $type)-get();
                    return UtilityController::generalResponse("success", $media);
                }

            case 'post':
                if ($type == "all") {
                    $media = Post::find($id)->media();
                    return UtilityController::generalResponse("success", $media);
                } else {
                    $media = Post::find($id)->media()->where('type', $type)-get();
                    return UtilityController::generalResponse("success", $media);
                }
        }
        return response()->file($url); 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $media = Media::find($id);

        $media->delete();   
    }

    public function destroy($id) {
        $media = Media::withTrashed()->where("id", $id)->get()->first();

        Storage::delete($media->url);
        $media->forceDelete();   
    }
}
