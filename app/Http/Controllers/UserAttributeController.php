<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAttribute;
use SebastianBergmann\CodeCoverage\Util;

class UserAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserAttribute::all();
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
        $data = json_decode($request->input('data'));
        if ($data) {
            return UtilityController::GeneralResponse('success', UserAttributeController::saveAttr($data));
        } else {
            return UtilityController::GeneralResponse('failed', 'data not well formated');
        }
    }

    /**
     * @param attr  UserAttribute model
     */
    public static function saveAttr($inAttr) {
        $attr = UserAttribute::where([["name", "=", $inAttr->name], ["user_id", "=", $inAttr->user_id]])->get()->first();
        if ($attr) {
            $attr->value = $inAttr->value;
            $attr->visibility = $inAttr->visibility;
            $attr->save();
        } else {
            $attr = new UserAttribute;
            $attr->name = $inAttr->name;
            $attr->value = $inAttr->value;
            $attr->user_id = $inAttr->user_id;
            $attr->visibility = $inAttr->visibility;
            $attr->save();
        }
        return $attr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ua = UserAttribute::find($id);
        return UtilityController::GeneralResponse('success', $ua);
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
        //return $request;
        // $data = json_decode($request->input('data'), true);
        // $ua = UserAttribute::updateOrCreate($data);
        // return UtilityController::GeneralResponse('success', $ua);
        $data = json_decode($request->input('data'));
        if ($data) {
            return UtilityController::GeneralResponse('success', UserAttributeController::saveAttr($data));
        } else {
            return UtilityController::GeneralResponse('failed', 'data not well formated');
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
        $ua = UserAttribute::find($id);
        $ua->delete();
        return UtilityController::GeneralResponse('success', 'deleted successfully');
    }
}
