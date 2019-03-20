<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('scripts')

</head>
<body>
@include('navbar')
<br>
<h2> <center> Manage videos  </center></h2>


<div class="container">
    <br>
    <h3>Upload Form for video</h3>
    <form method="post" action="{{url('/SaveVideo')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control-file" style="font-size: 22px;" name="videofile"/>
        </div>
        <br>
        <button type="submit" class="btn btn-primary  " style="margin-left: 100px;font-size: 22px;">Submit video</button>
    </form>
    <br>
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <br>
    <center><h3> Select a video </h3></center>

    <center><form method="post" action="{{url('/DownVideo')}}">
            @csrf
            <label>Records:</label>
            <select id="rec" class="form-control" type="text" name="videofileD" size="6" style="width: 600px; height:200px; font-size: 18px;">
                @foreach ($displayVid as $v)
                    <option value="{{$v->upload_name}}" >{{$v->upload_name}}</option>
                @endforeach
            </select>
            <br><br>
            <button type="submit" class="btn btn-primary " style="font-size: 20px;">Download</button>
        </form></center>
    <br>
    <form  id="formdelete" >
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <center><button type="submit" id="delete" style="margin:12px; font-size: 24px; width: 120px;"  class="btn btn-danger ">Delete</button></center>
    </form>
    <script>
        jQuery(document).ready(function(){
            jQuery('#delete').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{route('DeleteVideo')}}",
                    method: 'delete',
                    dataType: 'text',
                    data: {
                        Vid: jQuery('#rec').val()
                    },

                    success: function(result){
                        console.log(result);
                    },
                    error: function(jqXHR) {
                        if (jqXHR.status == 500) {
                            alert('Server side error');
                        } else if (jqXHR.status == 404) {
                            alert('not found');
                        }
                    }
                });
                window.location.reload();
            });
        });
    </script>
    <br>

</div>
@include('errors')
</body>
</html>


