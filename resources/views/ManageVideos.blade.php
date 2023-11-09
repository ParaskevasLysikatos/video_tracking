<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <title>Manage videos</title>
<head>
    @include('scripts')
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

</head>

<body>
    @include('navbar')
    <br>
    <h2 class="my-center"> Manage videos </h2>
    <br>

    <div class="container-fluid my-center">
        <div class=" row">

            <div class="col-5 mr-5">
                <h3>Upload Form for video</h3>
                <form method="post" action="{{ url('/SaveVideo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" class="form-control-file" style="font-size: 22px;" name="videofile" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary  " style="font-size: 22px;">Submit video</button>
                </form>

            </div>


            <div class="col-5 ml-5">
                <h3 class="my-center"> Select a video </h3>

                <form method="post" action="{{ url('/DownVideo') }}">
                    @csrf
                    <label>Records:</label>
                    <select id="rec" class="form-control" type="text" name="videofileD" size="1"
                        style="width: 300px;  font-size: 18px;">
                        @foreach ($displayVid as $v)
                            <option value="{{ $v->upload_name }}">{{ $v->upload_name }}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <button type="submit" class="btn btn-secondary " style="float:left;font-size: 20px;">Download</button>
                </form>

                <form style="float: right;" id="formdelete">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <button type="submit" id="delete" style="font-size: 20px; width: 120px;"
                        class="btn btn-danger ">Delete</button>
                </form>

            </div>

        </div>
    </div>

    <script>
        jQuery(document).ready(function() {
            jQuery('#delete').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('DeleteVideo') }}",
                    method: 'delete',
                    dataType: 'text',
                    data: {
                        Vid: jQuery('#rec').val()
                    },

                    success: function(result) {
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
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @include('errors')
    @include('/footer')
</body>

</html>
