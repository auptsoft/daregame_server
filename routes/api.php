<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/personal_token', function(Request $request){
    $email = $request->input('email');
    $password = $request->input('password');

    /*$user = App\User::where('email', $email)
    ->where('password', $password)
    ->get()->first(); //->createToken('App personal')->accessToken; */

    if(Auth::attempt(['email'=>$email, 'password'=>$password])) {
        return Auth::user()->createToken('App personal')->accessToken;
    } else {
        return "error";
    }

    
});

/*Route::post('/upload', function(Request $request){
    return $request->file('media_file')->store('uploads');
});*/


Route::get('/path', function(){
    return Storage::url('uploads/BlhBHuIxQYvFHZLnn2BfwynNiSakzCw4gKbkp3kg.jpeg');
});

Route::put('/user', function(Request $request){
    return App\User::find($request->input('id'));
});

Route::delete('/user', function(Request $request){
    return App\User::find($request->input('id'))->name." deleted";
});


Route::post('/search/{table}', 'UtilityController@search')->middleware('auth:api');

Route::post('/comment', 'CommentController@addComment')->middleware('auth:api');
Route::delete('/comment/{comment_id}', 'CommentController@removeComment')->middleware('auth:api');
Route::get('/comment/{commentable_type}/{commentable_id}', "CommentController@getComments")->middleware('auth:api');

Route::get('/challenge', 'ChallengeController@index'); //->middleware('auth:api');
Route::post('/challenge', 'ChallengeController@store')->middleware('auth:api');
Route::post('/challenge/update/{id}', 'ChallengeController@update')->middleware('auth:api');
Route::delete('/challenge/{id}', 'ChallengeController@delete')->middleware('auth:api');
Route::post('/challenge/search', 'ChallengeController@search')->middleware('auth:api');
Route::post('/challenge/{challenge_id}/attach_tags', 'ChallengeController@attachTags')->middleware('auth:api');
Route::post('/challenge/{challenge_id}/detach_tags', 'ChallengeController@detachTags')->middleware('auth:api');
Route::get('/challenge/{challenged_id}/tags', 'ChallengeController@getTags')->middleware('auth:api');

Route::post('follow/{id}', 'FollowingController@follow')->middleware('auth:api');
Route::delete('follow/{id}', 'FollowingController@unfollow')->middleware('auth:api');
Route::get('followers/{id}', 'FollowingController@followers');
Route::get('followings/{id}', 'FollowingController@followings');

Route::post('like/{likeable_type}/{likeable_id}', 'LikeController@like')->middleware('auth:api');
Route::delete('like/{likeable_type}/{likeable_id}', 'LikeController@unlike')->middleware('auth:api');



Route::post('/media', "MediaController@store");
Route::get('/media', "MediaController@index");
Route::delete('/media/{id}', "MediaController@delete");
//Route::delete('/destroyMedia/{id}', "MediaController@destroy");

Route::get('/post', 'PostController@index');
Route::post('/post', 'PostController@store');
Route::delete('/post/{id}', 'PostController@delete');
Route::post('post/update/{id}', 'PostController@update');
Route::post('/post/{post_id}/tags', 'PostController@attachTags');
Route::delete('/post/{post_id}/tags', 'PostController@detachTags');
Route::get('/post/{post_id}/tags', 'PostController@getTags');


Route::post('/tag', "TagController@store")->middleware('auth:api');
Route::get('/tag/{id}', "TagController@show")->middleware('auth:api');
Route::delete('/tag/{id}', "TagController@delete")->middleware('auth:api');
Route::get('/tag', "TagController@index");

Route::post('/register', 'UserController@store');
Route::post('/login', 'UserController@login');
Route::get('/profile', 'UserController@profile'); //->middleware('auth:api');
Route::get('/profile/details', 'UserController@details')->middleware('auth:api');
Route::get('/allusers', 'UserController@index');

Route::post('/message', 'MessageController@store');

Route::post('/report', 'ReportController@store');