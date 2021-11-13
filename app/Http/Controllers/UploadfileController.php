<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use  Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UploadfileController extends BaseController
{


    public function displayManageVideos(Request $request)
    {
        $displayVid=DB::table('upload_videos')->select('*')->get();
        return view('ManageVideos',['displayVid'=>$displayVid]);
    }


    public function SaveVideo(Request $request)
    {
        ini_set('max_execution_time', 600);
        request()->validate([
            'videofile' => 'required|file|mimes:mp4|unique:upload_videos,upload_name'
        ]);
        if($request->hasFile('videofile')) {
            //Get filename with the extension
            $filenamewithExt = $request->file('videofile')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('videofile')->guessClientExtension();

            $mytime = Carbon::now();
            $y=$mytime->year;
            $m=$mytime->month;
            $d=$mytime->day;
            //FileName to store
            $fileNameToStore = $filename.'.'.$extension;

            $ch=DB::table('upload_videos')->where('upload_name',$fileNameToStore)->exists();
            if($ch)
            {return redirect('ManageVideos')->withErrors("Upload failed cause file exists");}

            $path = $request->file('videofile')->storeAs('public/videos', $fileNameToStore,'s3');
            DB::table('upload_videos')->insert(['upload_name'=>$fileNameToStore]);


        }
        else{
            return redirect('ManageVideos')->withErrors("Upload failed");
        }


        return redirect('ManageVideos')->with('success', 'upload done successfully');
    }


    public function DownVideo(Request $request)
    {
        $selected = $request->input('videofileD');
    //    if(is_file((storage_path('app/public/videos/' . $selected)))) {
    //        return response()->download(storage_path('app/public/videos/' . $selected));
          return Storage::disk('s3')->download('public/videos/' . $selected);
    //    }
    //     else return redirect('ManageVideos')->withErrors("download failed");
    }


    public function DelVideo(Request $request)
    {
        $selected = $request->Vid;
        $check = DB::table('upload_videos')->where('upload_name','=',$selected)->exists();
       // $check2=is_file((storage_path('app/public/videos/' . $selected)));
       $check2=Storage::disk('s3')->exists('public/videos/'.$selected);
        if($check&&$check2) {
            DB::table('upload_videos')->where('upload_name','=',$selected)->delete();
           // Storage::delete('public/videos/'.$selected);
           Storage::disk('s3')->delete('public/videos/' . $selected);
        return redirect('ManageVideos')->with('success', 'deleted successfully');
        }
        else return redirect('ManageVideos')->withErrors("not found, check again");

    }

}