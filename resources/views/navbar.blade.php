<nav class="navbar navbar-expand-sm bg-dark navbar-dark"  style="position: fixed; top: 0;left:0;width: 100%;z-index: 1;">
    <div class="container-fluid ">
        <ul class="nav navbar-nav">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="active">  <a  class="nav-link" style="color: #f8f9fa; font-weight: bold" href="VideoDisplay">Home</a></li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li>   <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="ChooseVideoforUser">User's charts</a></li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li> <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="UsersSelect">Compare 2 user charts</a></li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li> <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="VideosHeatSelect">Videos Heatmap</a></li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li>   <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="EditName">Edit user's Name</a></li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="font-size:18px; color: #f8f9fa;">
                Sorted Lists
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="SortedUsers"  style="font-size:18px;">Sorted Users' List</a>
                <a class="dropdown-item" href="SortedVideos"  style="font-size:18px;">Sorted Videos' List</a>
            </div>
        </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li>  <a class="nav-link" style="color: #f8f9fa; font-weight: bold" href="ManageVideos">ManageVideos</a></li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li>    <a id="top" class="nav-link"  style="color: white; font-size: 18px;" href="">Scroll<img src="https://img.icons8.com/doodle/25/000000/up.png"> </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li>   <a class="nav-link" style="color: #00f9fa; font-weight: bold" href="{{ url('/SignOut') }}">SignOut</a></li>
        </ul>
    </div>
</nav>
<br>
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