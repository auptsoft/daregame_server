<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;


class VerificationApiController extends Controller
{
    use VerifiesEmails;

    public function show() {

    }

    public function verify(Request $request) {
        $userID = $request['id'];
        $user = User::findOrFail($userID);
        if($user->hasVerifiedEmail()) {
            return UtilityController::GeneralResponse('success', 'Email Already verified');
        } else {
            $date = date('Y-m-d g:i:s');
            $user->email_verified_at = $date;
            $user->save();

            return redirect('/verified');
        }
    }

    public function resend(Request $request) {
		
        $user = Auth::user(); // $request->user();
		
        if($user->hasVerifiedEmail()) {
            //return UtilityController::GeneralResponse('verified', 'Email Already verified');
        } else {
            $user->sendApiEmailVerificationNotification();
            return UtilityController::GeneralResponse('success', 'Email verification link sent');
        }
    }
}
