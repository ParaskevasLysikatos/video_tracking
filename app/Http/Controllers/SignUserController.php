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
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SignUserController extends BaseController
{

    public function SignInUser(Request $req)
    {
        request()->validate([
            'Username' => 'required',
        ]);
        $username = $req->input('Username');
         if(DB::table('users')->
        select('username')->where('username', $username)->exists())
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
            'username' => 'required|unique:users,username',
        ]);
        $username = $req->input('username');
        DB::table('users')->insert(['username'=>$username,'user_session'=>0]);
        return view('welcome');
    }

    public function EditName(Request $req)
    {
        request()->validate([
            'username' => 'required|unique:users,username',
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
        $username= DB::table('users')->select('username')->get();
        $video=DB::table('upload_videos')->select('upload_name')->get();
        return view('UsersSelect',['username'=>$username,'video'=>$video]);
    }



    public function DisplaySignUser(Request $req)
    {
        $username= DB::table('users')->select('username')->get();
        return view('SignIn',['username'=>$username]);
    }

    public function DisplayDeleteUser(Request $req)
    {
        $username= DB::table('users')->select('username')->get();
        return view('DeleteUser',['username'=>$username]);
    }

    public function SeeInspectVideo(Request $req)
    {
        request()->validate([
            'videoName' => 'required',
            'second' => 'required'
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


    public function DeleteUser(Request $req)
    {
        $username = $req->input('Username');
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