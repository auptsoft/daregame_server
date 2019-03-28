<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/example', function(){
    return view('example');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/authorize', function(){
    return view('/vendor/passport/authorize');
});

Route::get('/get_access_token', function() {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/blog/public/oauth/token', [
        'form_params'=> [
            'grant_type'=>'password',
            'client_id'=>'7',
            'client_secret'=>'usXPoOFfUXYqYiKW2yiMtVD3uZmsV9ve4sGr52W8',
            'username' => 'andrewoshodin@gmail.com',
            'password' => 'usifoh123',
            'scope' => '',
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});

Route::get('/redirect', function() {
    $query = http_build_query([
        'client_id' => '7',
        'redirect_uri' => 'http://localhost/blog/public/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost/blog/public/oauth/authorize?'.$query);
});

Route::get('/callback', function(Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/blog/public/oauth/token', [
        'form_params'=> [
            'grant_type'=>'authorization_code',
            'client_id'=> $request->client_id,
            'client_secret'=>'usXPoOFfUXYqYiKW2yiMtVD3uZmsV9ve4sGr52W8',
            'redirect_uri' => 'http://localhost/blog/public/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});

Route::get('/personal_token/{id}', function($id) {
    $user = App\User::find($id);
    $token = $user->createToken('App personal')->accessToken;
    return $token;
});

Route::post('/upload_file', "MediaController@store");


