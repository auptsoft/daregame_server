<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
       .card {
           margin-top: 20px;
           margin-bottom: 20px;
       }
       .header-text {
           font-size:20px;
       }

       .text-1 {

       }

       .text-2 {

       }

       .gotoLogin {
           margin-top: 20px;
           display: none;
       }
    </style>
</head>
<body>
  <div id="app">
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email Verified') }}</div>

                <div class="card-body">
                    <div class="text-1 alert alert-success"> {{ __('Welcome! Your email has been verified') }} </div>
                    <div class="text-2"> You can now login in the app </div>

                    <button  id="gotoLogin" class="gotoLogin btn btn-success" onclick="gotoLogin()"> Login </button>
                </div>
            </div>
        </div>
    </div>
  </div>
 </div>
   <script>
      /*var Android = {
          gotoLogin:function() {
              alert('hello');
          } 
      }; */

      var gt = function gotoLogin() {
          Android.gotoLogin();
      };

      window.onload = function() {
        var gotoLogin = document.getElementById('gotoLogin');
        if( Android != undefined) {
              gotoLogin.style = 'display: block';
              gotoLogin.onclick = gt;
        } 
      }
   </script>
</body>
</html>
