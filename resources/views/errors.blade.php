<br>
<div class="container">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
