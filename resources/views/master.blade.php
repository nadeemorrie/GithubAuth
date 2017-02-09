<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<meta id="token" name="token" value="{{ csrf_token() }}">
			<meta name="keywords" content="Github Info, Commits" />
			<meta name="description" content="List repos and commits for a logged in github user.">
			<link rel="icon" type="image/x-icon" href="favicon.ico">
			<title>Github Info</title>	
        	<link rel="stylesheet" href="{{url('css/app.css')}}">
    </head>
    <body>
    	<div class="container">
            @yield('content')
        </div>
    </body>
 </html>