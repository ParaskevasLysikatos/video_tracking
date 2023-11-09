<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>DeleteUser</title>
    @include('scripts')
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

</head>
<body>
<br>
<h2 class="my-center"> Delete an user</h2>
<br>

<div class="container-xl my-center">
    <form method="post" action="{{route('DeleteUser')}}">
        @method('delete')

            <label style="font-size:20px; " for="Username">Username to select:</label>
            <select class="form-control" style="width: 250px;" placeholder="Enter username" name="Username" required>
                <option></option>
                @foreach($username as $u)
                    <option>{{$u->username}} : {{$u->role}}</option>@endforeach
            </select>
        <br>

        <button style="float:left;font-size: 20px;" type="submit" class="btn btn-danger">Delete</button>
        <a style="float:right;" href="welcome"><button type="button" class="btn btn-success" style="width:90px; font-size:20px;">Back</button></a>
    </form>


</div>
<br>
@if (\Session::has('success'))
<div class="alert alert-success col-5">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif
@include('errors')
@include('/footer')
</body>
</html>
