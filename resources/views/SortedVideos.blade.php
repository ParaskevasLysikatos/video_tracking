<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title> Sorted Videos List Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
<!-- new nav starts here-->
@include('navbar')
<br>
<div class="content">
    <div class="title m-b-md">
        <h2 style="text-align: center;">Sorted Videos List</h2>
    </div>
    <br>
    <div>
        <center>
            <table class="table table-bordered col-3">
                <tr>
                    <th>Video names</th>
                    <th>Minutes</th>
                    <th>Seconds</th>
                    <th>Engagement % on duration</th>
                </tr>
                @foreach ($howmany as $v)
                    <tr>
                        <td> {{$v->video_name}} </td>
                        <td> {{floor($v->count/60)}} min</td>
                        <td> {{$v->count%60}} sec</td>
                        <td> {{round($v->count/$v->video_duration,2)*100}}%</td>
                    </tr>
                @endforeach
            </table>
        </center>
    </div>
    <br><center>
        <div id="1" style="height: 30%; width:60%; margin-left: 1%; "></div></center>
    <script>
        var xValue = [@foreach($howmany as $u)'{{$u->video_name}}',@endforeach];

        var yValue = [@foreach($howmany as $u){{$u->count}},@endforeach];

        var trace1 = {
            x: xValue,
            y: yValue,
            type: 'bar',
            text: yValue.map(String),
            textposition: 'auto',
            hoverinfo: 'none',
            marker: {
                color: 'rgb(158,202,225)',
                opacity: 1,
                line: {
                    color: 'rgb(8,48,107)',
                    width: 2
                }
            }
        };

        var data = [trace1];

        var layout = {
            title: 'Sorted Videos, y->seconds, x->videoname',font: {
                family: 'Arial',
                size: 16,
                color: 'rgb(00, 00, 00)'
            },
        };

        Plotly.newPlot('1', data, layout);
    </script>
    <br>
    <br>
    <div>
        <center>
            <table class="table table-bordered col-5">
                <tr>
                    <th>Videoname</th>
                    <th>Seconds per user</th>
                    <th>Engagement of user (user's time/video duration) %</th>
                </tr>
                @foreach ($howmanyU as $u)
                    <tr>
                        <td> {{$u->video_name}} </td>
                        <td> {{$u->countU}} sec, ->{{$u->video_user}}</td>
                        <td> {{round($u->countU/$u->video_duration,2)*100}}%</td>

                    </tr>
                @endforeach
            </table>
        </center>
    </div>
    <br>

    <center>
        <h4>Inspect video form</h4>
        <form method="post" action="{{route('InspectVideoS')}}">
            @csrf
            <div class="form-group col-md-2">
                <label style="font-size: 20px;">Select a video:</label>
                <div class="form-group">
                    <select class="form-control" placeholder="Select video" name="videoName" >
                        <option></option>
                        @foreach($video as $v)
                            <option>{{$v->upload_name}}</option>@endforeach
                    </select>
                </div>
                <label style="font-size: 20px;">Type the second:</label>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="Enter second" name="second" >
                </div>
            </div>
            <br>
            <button style="font-size: 20px;" type="submit" class="btn btn-primary">See video start</button>
        </form>
    </center>

</div>
<br>
@include('errors')
@include('/footer')
</body>
</html>
