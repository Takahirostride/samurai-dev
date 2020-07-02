
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Samurai</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                color: red;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
				  align-items: center;
				  justify-content: center;
				  display: flex;
            }

            .full-height {
                height: 100%;
            }

            .flex-center {
              
                
                
				background-color: rgba(0,0,0,0.1) !important;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100%;
                margin: 0;
				font-size:20px;
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

            <div class="content">
			
			<div> ▼{{$datass['displayname']}}（ユーザー名） から 
			<div> ━━━━━━━━━━━━━━━━━━━━━━━</div>
			<div>▼ {{$datass['policy_name']}}（施策名） </div>
			<div> ━━━━━━━━━━━━━━━━━━━━━━━</div>
			<div></div>
			<div>
			メッセージ内容は以下の通りです。
			</div>
			<div> {{$datass['message']}}
			</div>

            </div>
        </div>
    </body>
</html>
