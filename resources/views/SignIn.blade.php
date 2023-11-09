<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>SignIn</title>
    @include('scripts')
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

</head>
<body>
<br>

<h2 class="my-center"> Sign In Page</h2>
<br>

<div class="container-xl my-center">

    <form method="post" action="{{route('SignInUser')}}">
        @method('post')

            <label style="font-size:22px; width:300px;" for="Username">Username to select:</label>
            <select style="font-size:20px; width:300px;" class="form-control" placeholder="Enter username" id="Username" name="Username" required>
                <option></option>
                @foreach($username as $u)
                <option>{{$u->username}} : {{$u->role}}</option>@endforeach
            </select>
        <br>
        <button style="float:right;font-size: 20px;" type="submit" class="btn btn-primary mr-4">Sign In</button>
        <a href="welcome"><button type="button" class="btn btn-success" style="float:left;width:90px; font-size:20px;">Back</button></a>
    </form>


</div>

    <br>
@include('errors')
@include('/footer')
</body>
</html>
