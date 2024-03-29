<?php
/**
 * Created by PhpStorm.
 * User: Par
 * Date: 14-Feb-19
 * Time: 9:14 AM
 */

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SignUserController extends BaseController
{

    public function SignInUser(Request $req)
    {
        request()->validate([
            'Username' => 'required'
        ]);
        $username = explode(':',$req->input('Username'))[0];
         if(DB::table('users')->
        select('username','role')->where('username', $username)->exists())
         {
             $req->session()->put('Uname', $username);
             $Video= DB::table('upload_videos')->select('upload_name')->get();
             return view('VideoDisplay',['username'=>$username,'Video'=>$Video]);
         }
         else
             {
                 return redirect('SignIn')->withErrors("Sign In Failed due to wrong data passed. "." Username passed: ".$username);
             }
    }

    public function RegisterUser(Request $req)
    {
        request()->validate([
            'username' => 'required|unique:users,username|alpha|min:3',
            'Role' => 'required',
        ]);
        $username = $req->input('username');
        $role = $req->input('Role');
        DB::table('users')->insert(['username'=>$username,'user_session'=>0,'role'=>$role]);
        return view('welcome');
    }

    public function EditName(Request $req)
    {
        request()->validate([
            'username' => 'required|unique:users,username|alpha|min:3',
        ]);
        $username = $req->input('username');
        $usernameold = session('Uname');
        DB::table('info_videos')->where('video_user',$usernameold)->update(['video_user'=>$username]);
        DB::table('users')->where('username',$username)->update(['username'=>$username]);
        session(['Uname'=>$username]);
        return view('EditName',['username'=>$username]);
    }

    public function DisplaySelectUser(Request $req)
    {
        $username= DB::table('users')->select('username','role')->where('role','=','Student')->get();
        $video=DB::table('upload_videos')->select('upload_name')->get();
        return view('UsersSelect',['username'=>$username,'video'=>$video]);
    }

    public function DisplayOneUser(Request $req)
    {
        $username= DB::table('users')->select('username','role')->where('role','=','Student')->get();
        $video=DB::table('upload_videos')->select('upload_name')->get();
        return view('OneUserSelect',['username'=>$username,'video'=>$video]);
    }


    public function DisplaySignUser(Request $req)
    {
        $username= DB::table('users')->select('username','role')->get();
        return view('SignIn',['username'=>$username]);
    }

    public function DisplayDeleteUser(Request $req)
    {
        $username= DB::table('users')->select('username','role')->get();
        return view('DeleteUser',['username'=>$username]);
    }

    public function SeeInspectVideo(Request $req)
    {
        request()->validate([
            'videoName' => 'required',
            'second' => 'required|numeric'
        ]);
        $videoName = $req->input('videoName');
        $videoName2=substr($videoName,0,strlen($videoName)-4);
        $secGiven = $req->input('second');
        $sec=DB::table('info_videos')->select('video_duration')->where('video_name',$videoName2)->first();
        $secC=$sec->video_duration;
        if($secC>=$secGiven)
        {
            return view('InspectVideo',['videoName'=>$videoName,'secGiven'=>$secGiven]);
        }
        else
        {
            return redirect('SortedUsers')->withErrors("second don't exists");
        }
    }

    public function SecondsInspect(Request $req)
{
    //$videoName = $req->input('videoName');
    $videoName= session('VideoHeat');
    $secGiven = $req->input('second');
    if($secGiven==null)
    {return redirect('VideosHeatSelect')->withErrors("not second given");}
    if(!is_numeric($secGiven))
    {return redirect('VideosHeatSelect')->withErrors("non numeric second given");}
    $sec=DB::table('info_videos')->select('video_duration')->where('video_name',$videoName)->first();
    $secC=$sec->video_duration;
    if($secGiven>$secC || $secGiven<0 )
    {return redirect('VideosHeatSelect')->withErrors("second don't exists");}
    $videoName=$videoName.".mp4";
    return view('InspectVideo',['videoName'=>$videoName,'secGiven'=>$secGiven]);
}

    public function SecondsInspect2(Request $req)
    {
       // $videoName = $req->input('videoName');
        $videoName= session('VideoHeat');
        $secGiven2 = $req->input('second');
        if($secGiven2==null)
        {return redirect('VideosHeatSelect')->withErrors("not second given");}
        if(!is_numeric($secGiven2))
        {return redirect('VideosHeatSelect')->withErrors("non numeric second given");}
        $sec=DB::table('info_videos')->select('video_duration')->where('video_name',$videoName)->first();
        $secC=$sec->video_duration;
        if($secGiven2>$secC || $secGiven2<0)
        {return redirect('VideosHeatSelect')->withErrors("second don't exists");}
        $videoName=$videoName.".mp4";
        $secGiven=$secC/100*$secGiven2 ;
        return view('InspectVideo',['videoName'=>$videoName,'secGiven'=>$secGiven]);
    }


    public function SecondsInspect3(Request $req)
    {
       // $videoName = $req->input('videoName');
        $videoName= session('VideoHeat');
        $secGiven2 = $req->input('second');
        if($secGiven2==null)
        {return redirect('VideosHeatSelect')->withErrors("not second given");}
        if(!is_numeric($secGiven2))
        {return redirect('VideosHeatSelect')->withErrors("non numeric second given");}
        $sec=DB::table('info_videos')->select('video_duration')->where('video_name',$videoName)->first();
        $secC=$sec->video_duration;
        if($secGiven2>$secC || $secGiven2<0 )
        {return redirect('VideosHeatSelect')->withErrors("second don't exists");}
        $videoName=$videoName.".mp4";
        $secGiven=$secC/100*$secGiven2 ;
        return view('InspectVideo',['videoName'=>$videoName,'secGiven'=>$secGiven]);
    }

    public function DeleteUser(Request $req)
    {
        $username =  explode(':',$req->input('Username'))[0];
        if(DB::table('users')->where('username',$username)->exists())
        {
            DB::table('info_videos')->where('video_user',$username)->delete();
            DB::table('users')->where('username',$username)->delete();
        return redirect('DeleteUser')->with('success', 'delete done successfully');
        }
        else return redirect('DeleteUser')->withErrors("delete failed");
    }

    public function SignOutUser()
    {
        Session::flush();
        return view('/welcome');
    }

    public function DisplayEditName()
    {
        $username = session('Uname');
        return view('EditName',['username'=>$username]);
    }

    public function VideosHeatmap()
    {
        $video= DB::table('upload_videos')->select('upload_name')->get();
        return view('VideosHeatSelect',['video'=>$video]);
    }

    public function Display()
    {
        $username = session('Uname');
        $Video= DB::table('upload_videos')->select('upload_name')->get();
        return view('VideoDisplay',['username'=>$username,'Video'=>$Video]);
    }

    public function ChooseVideoforUser()
    {
        $username = session('Uname');
        $video=DB::table('upload_videos')->select('upload_name')->get();
        return view('ChooseVideoforUser',['video'=>$video,'username'=>$username]);
    }

}