<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body style="margin-top: 5%;">
<br>
<center><h1> Register Page</h1></center>
<br>
<center>
    <form method="post" action="{{route('RegisterUser')}}">
        @csrf
        <div class="form-group col-md-2">
            <label style="font-size: 20px;" for="Username">Type an username:</label>
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="Enter username" name="username">
            </div>
        </div>
        <br>
        <div class="form-group col-md-2">
            <label style="font-size:20px; " for="Username">Role to select:</label>
            <select class="form-control" placeholder="Enter role" name="Role" required>
                <option></option>
                <option>Student</option>
                <option>Lecturer</option>
            </select>
        </div>
        <br>
        <button style="font-size: 20px;" type="submit" class="btn btn-primary">Register</button>
    </form>
</center>
<center>
<a href="welcome"><button type="button" class="btn btn-success" style="width:90px; margin-top:2%; font-size:20px;">Back</button></a></center>
<br>
@include('errors')
@include('/footer')
</body>
</html>
