<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('catalog.news')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <style>
        @media (min-width: 768px) {
            .omb_row-sm-offset-3 div:first-child[class*="col-"] {
                margin-left: 25%;
            }
        }

        .omb_login .omb_authTitle {
            text-align: center;
            line-height: 300%;
        }

        .omb_login .omb_socialButtons a {
            color: white; // In yourUse @body-bg
        opacity:0.9;
        }
        .omb_login .omb_socialButtons a:hover {
            color: white;
            opacity:1;
        }
        .omb_login .omb_socialButtons .omb_btn-vk {background: #3b5998;}
        .omb_login .omb_socialButtons .omb_btn-github {background: #090404;}
        .omb_login .omb_socialButtons .omb_btn-google {background: #c32f10;}
    </style>
</head>
<body>
    <div class="container">

        <div class="omb_login">
            <h3 class="omb_authTitle">@lang('catalog.login')</h3>
            <div class="row omb_row-sm-offset-3 omb_socialButtons">
                <div class="col-xs-4 col-sm-2">
                    <a href="/login/vkontakte" class="btn btn-lg btn-block omb_btn-vk">
                        <span class="hidden-xs">VK</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="/login/github" class="btn btn-lg btn-block omb_btn-github">
                        <span class="hidden-xs">GitHub</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="/login/google" class="btn btn-lg btn-block omb_btn-google">
                        <span class="hidden-xs">Google</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>