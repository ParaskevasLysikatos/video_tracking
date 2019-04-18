<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('/scripts')

        <title>Video display tracking</title>


        <!-- Styles -->
        <style>
             .grid-container {
                 display: grid;
                 grid-gap: 5px;
                 padding: 5px;
             }

        </style>
    </head>
    <body>
    @include('/navbar')
            <div class="grid-container">
                    <h1 style="font-size: 30px;   margin:5px;  text-align: center; ">Video Display </h1>
                <h6 style="   text-align: center; ">Current user: {{$username}} </h6>
                <p id="nm"  hidden>{{$username}}</p>
                <button id="btn" hidden></button>
                </div>

                <div class="col-xl-10" style="margin-left: 3%;">
                    @foreach($Video as $v)
                    <div>
                         <h5 style="alignment: left; margin-left: 15%; display:flow ;">Video: {{$v->upload_name}}</h5>
                <video name="video" id="{{$v->upload_name}}" style="alignment: left; display:flow;  margin: 1%;"   width="40%" height="50%" controls src="storage/videos/{{$v->upload_name}}" type="video/mp4" preload="metadata">
                    Your browser does not support the video tag.
                </video>
                </div>
                    @endforeach
            </div>
    <script src="js/main.js"></script>
    <br>
    <br>
    <br>
    </body>
</html>
