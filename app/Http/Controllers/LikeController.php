<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Like;

class LikeController extends Controller
{
    public function like($likeable_type, $likeable_id) {
        $lk = Like::where([
            ['likeable_type', '=', $likeable_type],
            ['likeable_id', '=', $likeable_id]
        ])->get()->first();

        if(!$lk) {
            $like = new Like;
            $like->user_id = Auth::user()->id;
            $like->likeable_type = $likeable_type;
            $like->likeable_id = $likeable_id;

            $like->save();
            return UtilityController::GeneralResponse("success", "Item added to your likes");
        } else {
            return UtilityController::GeneralResponse("failed", "Item already in your likes");
        }
    }

    public function unlike($likeable_type, $likeable_id) {
        $lk = Like::where([
            ['likeable_type', '=', $likeable_type],
            ['likeable_id', '=', $likeable_id]
        ])->get()->first();
        if ($lk) {
            $lk->delete();
            return UtilityController::GeneralResponse("success", "Item removed to your likes");
        } else {
            return UtilityController::GeneralResponse("failed", "Item is not currently in your likes");
        }
    }

    public function toggleLike($likeable_type, $likeable_id) {
        $lk = Like::where([
            ['likeable_type', '=', $likeable_type],
            ['likeable_id', '=', $likeable_id]
        ])->get()->first();

        if(!$lk) {
            $like = new Like;
            $like->user_id = Auth::user()->id;
            $like->likeable_type = $likeable_type;
            $like->likeable_id = $likeable_id;

            $like->save();
            return UtilityController::GeneralResponse("liked", "Item added to your likes");
        } else {
            $lk->delete();
            return UtilityController::GeneralResponse("unliked", "Item removed to your likes");
        }
    
    }
}