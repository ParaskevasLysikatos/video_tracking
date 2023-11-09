<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Register</title>
    @include('scripts')
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

</head>
<body>
<br>
<h2 class="my-center"> Register Page</h2>
<br>
<div class="container-xl my-center">

    <form method="post" action="{{route('RegisterUser')}}">
        @csrf
        <div class="form-group col-6">
            <label  style="width: 300px;" style="font-size: 20px;" for="username">Type an username:</label>
            <div class="form-group">
                <input  style="width: 300px;" type="text" class="form-control"  placeholder="Enter username" id="username" name="username">
            </div>
        </div>
        <br>
        <div class="form-group col-6">
            <label style="font-size:20px; " for="role">Role to select:</label>
            <select  style="width: 300px;" class="form-control" placeholder="Enter role" id="role" name="Role" required>
                <option></option>
                <option>Student</option>
                <option>Lecturer</option>
            </select>
        </div>
        <br>
        <button  style="font-size: 20px;" type="submit" class="btn btn-primary">Register</button>
        <a class="ml-5" href="welcome"><button type="button" class="btn btn-success" style="width:90px; font-size:20px;">Back</button></a>
    </form>


</div>
<br>
@include('errors')
@include('/footer')
</body>
</html>
