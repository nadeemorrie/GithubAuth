<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Github Log In</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .link {
                font-size: 40px;
                color: #4682b4;                
            }
            .link-container{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Powered by Laravel Socialite</div>
                <div class="link-container">Github <a class="link" href="{{url('auth/github/login')}}">Log In</a></div>
            </div>
        </div>
    </body>
</html>
