<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
@include('/scripts')
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
        }



        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        #ex1:hover {
            color: dodgerblue;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 75px;
        }

        .links > a {
            color: #636b6f;
            padding:  10px;
            font-size: 25px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;

        }

        .m-b-md {
            margin-bottom: 3%;
            margin-top: 14%;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="title m-b-md">
        Welcome to video tracking
    </div>
</div>
<div class="links flex-center" >
    <a id="ex1" style="margin-right:3%;" href="SignIn">Sign in</a>
    <a id="ex1"  style="margin-left:3%;margin-right:3%;" href="Register">Register an user</a>
    <a id="ex1" style="margin-left:3%;" href="DeleteUser">Delete an user</a>
</div>


@include('/footer')
</body>
</html>
