<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
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
                font-size: 35px;
                font-weight : 1000;
                margin-bottom: 15px;
                color :#e64d2e;
                    margin-top: -3rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <a class=" d-flex align-items-center" href="#" style="vertical-align:middle;">
                    <object type="image/svg+xml" class="svg-icons d-flex ml-auto mr-auto" data="{{URL::asset('assets/icons/banavision.svg')}}" style="width: 25rem;margin-top: -15rem"></object></a>
                
                <div class="title"><span style="font-size:50px">500</span> <br>This account is inactive.</div>
                <div><input type="text" class="form-control form-control-sm" style="border-radius: 3rem"></div>
            </div>
        </div>
    </body>
</html>
