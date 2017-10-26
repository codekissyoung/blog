<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="baidu-site-verification" content="ZhYNGyoyvk" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <title>Code Kiss Young</title>

        <!-- Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Code Kiss Young
                </div>

                <div class="links">
                    <a href="http://blog.codekissyoung.com">博客</a>
                    <a href="https://weibo.com/523486790">微博</a>
                    <a href="https://juejin.im/user/57d615070e3dd90069de4517">掘金</a>
                    <a href="https://my.oschina.net/codekissyoung">开源中国</a>
                    <a href="https://toutiao.io/u/304704">开发者头条</a>
                    <a href="https://www.zhihu.com/people/codekissyoung/activities">知乎</a>
                    <a href="https://segmentfault.com/u/codekissyoung">segmentfault</a>
                    <a href="https://github.com/codekissyoung">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
