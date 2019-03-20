<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EditName</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body style="margin-top: 5%;">
@include('/navbar')
<br>
<br>
<center><h1> Edit Name Page</h1></center>
<br>
<center>
    <form method="post" action="{{route('EditName')}}">
        @method('post')
        <div class="form-group col-md-4">
            <label style="font-size:20px; " for="Username">Username is right now: {{$username}} </label>
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="Edit username" name="username">
            </div>
        </div>
        <br>
        <button style="font-size: 20px;" type="submit" class="btn btn-primary">Edit username</button>
    </form>
    <br>

</center>
<center>
    <a href="VideoDisplay"><button type="button" class="btn btn-success" style="width:90px; margin-top:2%; font-size:20px;">Back</button></a></center>
<br>
@include('errors')
</body>
</html>
