<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Following;
use App\User;

class FollowingController extends Controller
{
    public function follow($id) {
        $f = Following::where([
            ['follower_id', '=', Auth::user()->id],
            ['following_id', '=', $id]
        ])->get()->first();
        if(!$f){
            $following = new Following;
            $following->follower_id = Auth::user()->id;
            $following->following_id = $id;
            $following->save();
            return UtilityController::GeneralResponse("success", "You are now following this user");
        } else {
            return UtilityController::GeneralResponse("failed", "You are already following this user");
        }
    }

    public function unfollow($id) {
        $f = Following::where([
            ['follower_id', '=', Auth::user()->id],
            ['following_id', '=', $id]
        ])->get()->first();
        if($f) {
            $f->delete();
            return UtilityController::GeneralResponse("success", "You are no longer following this user");
        } else {
            return UtilityController::GeneralResponse("failed", "You are not following this user already");
        }
    }
	
	public function followers($id) {
		$followerModels = User::find($id)->followers()->get();
		$followerUsers = $followerModels->map(function($item) {
			return User::find($item->following_id);
		});
		
		return $followerUsers->paginate();
	}
	
	public function followings($id) {
		$followingModels = User::find($id)->followings()->get();
		$followingUsers = $followingModels->map(function($item) {
			return User::find($item->follower_id);
		});
		return $followingUsers->paginate();
	}
}
