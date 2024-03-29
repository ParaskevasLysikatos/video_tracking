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
             h5 span {
                 position:absolute;
                 bottom:0;
                 right:0;

             }

        </style>
    </head>
    @php
         use Illuminate\Support\Facades\DB;
         use Illuminate\Support\Facades\Storage;
            $total=DB::table('upload_videos')->count();
    @endphp
    <body>
    @include('/navbar')
    @include('errors')
            <div class="grid-container">
                    <h1 style="font-size: 30px;   margin:1%;  text-align: center; ">Video Display </h1>
                {{-- <h6 style="   text-align: center; font-size: 18px;color: #1d643b;  font-weight: bold; ">Current user: {{$username}} </h6> --}}
                <h6 style="   text-align: center; font-size: 18px;color: #1d643b;  font-weight: bold; ">Total videos  @php echo $total @endphp </h6>
                <p id="nm" hidden>{{$username}}</p>
                <button id="btn" hidden></button>
                </div>
    <br>
    <br>
                <center>
                <div class="col-xl-10" style="margin-right: 95%;">
                    @foreach($Video as $v)
                    <div>

                        <span style="color: #5a6268; font-weight: bold;font-size: medium"></span>   <h5 style="alignment: left; display:flow; padding-right: auto; position:relative;"> Video: {{$v->upload_name}}</h5>
                <video name="video" id="{{$v->upload_name}}" style="alignment: left; display:flow;  margin: 1%;"   width="800px" height="350px" controls src="https://video-tracking-paraskevas.s3.eu-central-1.amazonaws.com/{{$v->upload_name}}   " type="video/mp4" preload="auto">
                    Your browser does not support the video tag.
                    {{-- storage/videos/{{$v->upload_name}} --}}
                </video>

                </div>
                        <br>

                    @endforeach
            </div>

                </center>
    <script>
        var b=document.getElementsByTagName("span");
        var n = 0;
        $('span').each(function()
        {
            //console.log("next <p> element with id: " + $(this).attr('id'));
            //document.getElementById("num").document.write(n++);
           // $(this).html(n++);
           // $(this).html( $("video").size());
                if (n < b.length) {
                    n++;
                }
                $(this).html(n);

        });
    </script>
    <script src="js/main.js"></script>
    <br>
    <br>
    <br>
    @include('/footer')
    </body>
</html>
