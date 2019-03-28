<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate();
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
		
        $userIn = json_decode($request->input('data'));
        if($userIn) {
            $user = new User;
            $user->name = $userIn->name;
            $user->email = $userIn->email;
			$user->username = $userIn->username;
            $user->password = $userIn->password;
            $u = User::where('email', $userIn->email)->get()->first();
			
			if(User::where('username', $userIn->username)->get()->first()){
				return UtilityController::generalResponse("failed", "username already used");
			}
			
            if(User::where('email', $userIn->email)->get()->first()) {
				return UtilityController::generalResponse("failed", "email already used");
            } 
			
			$user->save();    
			//perform verification through email-- to be implemented
            return UtilityController::generalResponse("success", $user->createToken('App personal')->accessToken);

			
        } else {
            return UtilityController::generalResponse("failed", "invalid input data");
        }
    }

    public function login(Request $request) {
        $userIn = json_decode($request->input('data'));
        if($userIn) {
            $user = new User;
            //$user->name = $userIn->name;
            $user->email = $userIn->email;
            $user->password = $userIn->password;

            if(Auth::attempt(['email'=>$userIn->email, 'password'=>$userIn->password])) {
                $token = Auth::user()->createToken('App personal')->accessToken;
                return UtilityController::generalResponse("success", $token);
            } else {
                return UtilityController::generalResponse("failed", "incorrect email or password");
            }
        } else {
            return UtilityController::generalResponse("failed", "invalid input data");
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
        return User::find($id);
    }

    public function details(){
        $details = Auth::user()->details()->get();
		if($details) {
			return UtilityController::GeneralResponse("success", $details);
		} else {
			return UtilityController::GeneralResponse("failed", "details does not exist for this user");
		
		}
    }
    
    public function profile() {
        return UtilityController::GeneralResponse("success", Auth::user());
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
    public function destroy($id)
    {
        //
    }
}
