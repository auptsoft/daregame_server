<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetails;
use App\User;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $userDetailsIn = json_decode($request->input('data'));
        if($userDetailsIn) {
            $userDetails = new UserDetails;
            $userDetails->user_id = $userDetailsIn->user_id;
            $userDetails->username = $userDetailsIn->username;
            $userDetails->phoneNumber = $userDetailsIn->phoneNumber;
            $userDetails->gender = $userDetailsIn->gender;
            $userDetails->country = $userDetailsIn->country;
            $userDetails->state = $userDetailsIn->state;
            $userDetails->city = $userDetailsIn->city;
            $userDetails->address = $userDetailsIn->address;
            $userDetails->profile_picture_url = $userDetailsIn->profile_picture_url;
            $userDetails->date_of_birth = $userDetailsIn->date_of_birth;

            $userDetails->save();
            return UtilityController::GeneralResponse("success", $userDetails);
        } else {
            return UtilityController::GeneralResponse("failed", 'data not well formated');
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
        return UtilityController::GeneralResponse("success", UserDetails::find($id));
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
        $userDetailsIn = json_decode($request->input('data'));
        if($userDetailsIn) {
            $userDetails = UserDetails::find($id);
            if (!$userDetails) $userDetails = new UserDetails;
            $userDetails->user_id = $userDetailsIn->user_id;
            $userDetails->username = $userDetailsIn->username;
            $userDetails->phoneNumber = $userDetailsIn->phoneNumber;
            $userDetails->gender = $userDetailsIn->gender;
            $userDetails->country = $userDetailsIn->country;
            $userDetails->state = $userDetailsIn->state;
            $userDetails->city = $userDetailsIn->city;
            $userDetails->address = $userDetailsIn->address;
            $userDetails->profile_picture_url = $userDetailsIn->profile_picture_url;
            $userDetails->date_of_birth = $userDetailsIn->date_of_birth;

            $userDetails->save();
            return UtilityController::GeneralResponse("success", $userDetails);
        } else {
            return UtilityController::GeneralResponse("failed", 'data not well formated');
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
        //
    }
}
