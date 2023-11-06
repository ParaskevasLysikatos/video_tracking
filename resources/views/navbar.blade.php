<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"  style="z-index: 1;">
    <div class="container-fluid ">
        <style>
            .navbar-nav > li{margin-left: .2em;
                margin-right: .2em; margin-top:0.5%;}
            .navbar-nav .nav-link:hover {background-color:#545b62;}
        </style>
        @php
            use Illuminate\Support\Facades\Session;
            use Illuminate\Support\Facades\DB;
            $name=Session::get('Uname');
            $roleS='Student';
            $findS=DB::table('users')->select('role')->where('username',$name)->where('role',$roleS)->exists();
            $roleL='Lecturer';
            $findL=DB::table('users')->select('role')->where('username',$name)->where('role',$roleL)->exists();
            $getRole=DB::table('users')->where('username',$name)->first();
        @endphp
        <ul class="nav navbar-nav">

            <li class="active">  <a  class="nav-link" style="color: #f8f9fa; font-weight: bold" href="VideoDisplay">Home</a></li>

            @if($findS)
            <li>   <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="ChooseVideoforUser">User's charts</a></li>
            @endIf
            @if($findL)
            <li> <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="OneUserSelect">Specific user's charts</a></li>

            <li> <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="UsersSelect">Compare 2 users' charts</a></li>

            <li> <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="VideosHeatSelect">Videos' Heatmap</a></li>
            @endif
            <li>   <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="EditName">Edit user's Name</a></li>

             @if($findL)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="font-size:18px; color: #f8f9fa;">
                Sorted Lists
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="SortedUsers"  style="font-size:18px;">Sorted Users' List</a>
                <a class="dropdown-item" href="SortedVideos"  style="font-size:18px;">Sorted Videos' List</a>
            </div>
        </li>
        <li>  <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="ManageVideos">ManageVideos</a></li>
             @endif

            <li>    <a id="top" class="nav-link"  style="color: white; font-size: 18px;" href="">Scroll<img src="https://img.icons8.com/doodle/20/000000/up.png"> </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li style="color: #00f9fa; font-weight: bold;padding-right:1px; margin-right:20px;" class="nav-link" >@php echo $name @endphp @php echo ': '.$getRole->role @endphp</li>
        <li>   <a class="nav-link" style="color: #00f9fa; font-weight: bold;padding-right:1px;" href="{{ url('/SignOut') }}">SignOut</a></li>
        </ul>
    </div>
</nav>
<br>
<br>
<br>


<script>
    //scroll to bottom
    $(document).ready(function() {

        $('body').dblclick(function(){
            $('html, body').animate({scrollTop:$(document).height()}, 'slow');
            return false;
        });

    });
</script>
<script>
    //scroll to top
    $(document).ready(function() {

        $('#top').click(function(){
            $("html,body").animate({scrollTop:0}, 'slow');
            return false;
        });

    });
    </script>
