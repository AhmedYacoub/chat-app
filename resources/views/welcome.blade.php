<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background: url("{{ asset('img/email-pattern.png') }}");
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a  {
                color: #636b6f;
                padding: 0 25px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
            .links > p {
                font-size: 20px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .logo {
                display: flex;
                max-width: 500px;
            }

            .logo  img {
                max-width: 128px;
                max-height: 128px;
                flex: 1;
                margin: 0px 44px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel Chat App
                </div>

                <div class="links">
                    <p>Basic Facebook messanger like app using Laravel, Pusher and Laravel Echo.</p>
                </div>

                <div class="logo">
                    <a href="https://laravel.com/" title="Laravel Framework">
                        <img src="{{ asset('images/LaravelLogo.png') }}" alt="Laravel Logo">
                    </a>
                    <a href="https://pusher.com/" title="Pusher JS">
                        <img src="{{ asset('images/PusherJs.png') }}" alt="Pusher JS Logo">
                    </a>
                    
                    <a href="https://laravel.com/docs/5.8/broadcasting#installing-laravel-echo" title="Laravel Echo">
                        <img src="{{ asset('images/LaravelEcho.png') }}" alt="Laravel Echo Logo">
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
