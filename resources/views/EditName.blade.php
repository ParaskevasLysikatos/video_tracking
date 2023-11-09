<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>EditName</title>
    @include('scripts')
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">
</head>

<body>
    @include('navbar')
    <h2 class="my-center"> Edit Name Page</h2>
    <br>
    <div class="container-xl my-center">
        <form method="post" action="{{ route('EditName') }}">
            @method('post')

            <label style="font-size:20px; " for="Username">Username is right now: {{ $username }} </label>

            <input type="text" class="form-control" placeholder="Edit username" id="username" name="username">
            <br>
            <button style="float:left;font-size: 20px;" type="submit" class="btn btn-primary">Edit username</button>

            <a class="ml-4" style="float:right;" href="VideoDisplay"><button type="button" class="btn btn-success"
                    style="width:90px; font-size:20px;">Back</button></a>
        </form>

    </div>
    <br>
    @include('errors')
    @include('/footer')
</body>

</html>
