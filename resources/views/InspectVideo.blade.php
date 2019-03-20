<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('/scripts')

    <title>Video Inspection</title>


    <!-- Styles -->
    <style>
        .grid-container {
            display: grid;
            grid-gap: 10px;
            padding: 10px;
        }

    </style>
</head>
<body>
@include('/navbar')

<div class="grid-container">
    <h1 style="font-size: 30px;   margin:1%;  text-align: center; ">Video inspection </h1>
    <p id="sec"  hidden>{{$secGiven}}</p>
    <button id="btn" hidden></button>
</div>
<center>
<div class="col-xl-10" style="margin-left: 3%;">
        <div>
            <h5 style="alignment: left;  display:flow ;">Video: {{$videoName}}</h5>

            <video name="video" id="video" style="alignment: left; display:flow;  margin: 1%;"   width="60%" height="50%" controls src="storage/videos/{{$videoName}}" type="video/mp4" preload="auto">
                Your browser does not support the video tag.
            </video>
        </div>
</div>
</center>
<script>
    var sec = document.getElementById('sec').value = document.getElementById('sec').innerHTML;
    console.log('sec:'+sec);
    var sec2 = parseInt(sec,10);
    console.log('sec2:'+sec2);
    var vid=document.getElementsByTagName('video')[0];
    console.log('video:'+vid);
    vid.addEventListener('loadedmetadata', function() {
        vid.currentTime = sec2;
    }, false);
</script>
</body>
</html>