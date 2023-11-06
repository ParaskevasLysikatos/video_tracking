<!DOCTYPE html>
<html>
<head>
    <title>UsersSelect</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
@include('navbar')
<style>
    select {
        height: 20%;
        width: 20%;
    }
</style>

<center><h1> Select 2 users to compare</h1></center>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <form for="" method="post" action="{{route('UserSelect')}}">
                @csrf
                <center><h3>First user:</h3></center>
                <center> <label> Select one: </label></center>
                <center><select class="container" type="text" name="username1"  size="4" style="font-size:20px;width: 300px; height: 150px;">
                        @foreach ($username as $u)
                            <option value="{{$u->username}}" > {{$u->username}}</option>
                        @endforeach
                    </select></center>
                <br>
        <div class="col-sm">
            <center><h3>Second user:</h3></center>
            <center> <label> Select one: </label></center>
            <center> <select class="container" type="text" name="username2"  size="4" style="font-size:20px; width: 300px ;    height: 150px;">
                    @foreach ($username as $u)
                        <option value="{{$u->username}} " > {{$u->username}}</option>
                    @endforeach
                </select></center>
        </div>
            <br>
                <center>
                <div class="form-group col-md-2">
                    <label style="font-size: 20px;">Select a video:</label>
                    <div class="form-group">
                        <select class="form-control" placeholder="Select video" name="videoName" >
                            <option></option>
                            @foreach($video as $v)
                                <option>{{$v->upload_name}}</option>@endforeach
                        </select>
                    </div>
                </div>
                </center>
            <center><button type="submit" class="btn btn-primary" style="margin: 15px; font-size:22px;">Compare</button></center>
            </form>
        </div>
    </div>
</div>
<br>
@include('errors')
@include('/footer')
</body>
</html>
