<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\DataTables\Formats\Format;
use Khill\Lavacharts\Lavacharts;
class SaveController extends Controller
{

    public function store(Request $req)
    {
        $now = Carbon::now();
        $nowD=$now->toFormattedDateString();
        $nowT=$now->toTimeString();
        $name = $req->Qname;
        $event= $req->Qevent;
        $timeS = $req->QtimeStart;
        $timeE= $req->QtimeEnd;
        $progress = $req->Qprogress;
        $progress5 = $req->Qprogress5;
        $duration = $req->Qduration;
        $video_user=$req->Qusername;
        if(!DB::table('users')->select('role','username')->where('role','=','Lecturer')->where('username','=',$video_user)->first()) {
            DB::table('info_videos')->insert(['video_name' => $name, 'video_event' => $event, 'video_current_timeStart' => $timeS, 'video_current_timeEnd' => $timeE, 'video_progress' => $progress, 'video_progress5' => $progress5, 'video_date' => $nowD, 'video_datetime' => $nowT, 'video_duration' => $duration, 'video_user' => $video_user]);
        }return "success";
    }

    public function store2(Request $req)
    {
        $now = Carbon::now();
        $nowD=$now->toFormattedDateString();
        $nowT=$now->toTimeString();
        $name = $req->Qname;
        $event= $req->Qevent;
        $timeS = $req->QtimeStart;
        $timeE= $req->QtimeEnd;
        $progress = $req->Qprogress;
        $progress5 = $req->Qprogress5;
        $duration = $req->Qduration;
        $video_user=$req->Qusername;
        if(!DB::table('users')->select('role','username')->where('role','=','Lecturer')->where('username','=',$video_user)->first()) {
            DB::table('info_videos')->insert(['video_name' => $name, 'video_event' => $event, 'video_current_timeStart' => $timeS, 'video_progress' => $progress, 'video_progress5' => $progress5, 'video_date' => $nowD, 'video_datetime' => $nowT, 'video_duration' => $duration, 'video_user' => $video_user]);
            $last = DB::table('info_videos')->where('video_event', '=', 'video play')->orderByDesc('info_id')->select('info_id')->first();
            DB::table('info_videos')->where('info_id', '=', $last->info_id)->update(['video_current_timeEnd' => $timeE]);
        } return "success";
    }

    public function store3(Request $req)
    {
        $now = Carbon::now();
        $nowD=$now->toFormattedDateString();
        $nowT=$now->toTimeString();
        $name = $req->Qname;
        $event= $req->Qevent;
        $timeS = $req->QtimeStart;
        $timeE= $req->QtimeEnd;
        $progress = $req->Qprogress;
        $progress5 = $req->Qprogress5;
        $protectPlay=$req->Qplay;
        $duration = $req->Qduration;
        $video_user=$req->Qusername;
        if(!DB::table('users')->select('role','username')->where('role','=','Lecturer')->where('username','=',$video_user)->first()) {
            DB::table('info_videos')->insert(['video_name' => $name, 'video_event' => $event, 'video_fromJump' => $timeE, 'video_current_timeStart' => $timeS, 'video_progress' => $progress, 'video_progress5' => $progress5, 'video_date' => $nowD, 'video_datetime' => $nowT, 'video_duration' => $duration, 'video_user' => $video_user]);
            $last = DB::table('info_videos')->where('video_event', '=', 'video play')->orderByDesc('info_id')->select('info_id')->first();
            DB::table('info_videos')->where('info_id', '=', $last->info_id)->update(['video_current_timeEnd' => $protectPlay]);
        }return "success";
    }

    public function SortedVideos()
    {
        $firstVid=DB::table('upload_videos')->select('*')->first();
        $howmany = DB::table('info_videos')->select(DB::raw('DISTINCT video_name,COUNT(*) as count,video_event,video_duration'))->groupBy('video_event','video_name','video_duration')->where('video_event', '=', 'video second played')->orderByDesc('count')->get();
        $howmanyU = DB::table('info_videos')->select(DB::raw('DISTINCT video_user, video_name,COUNT(*) as count,video_event,COUNT(video_name) as countU,video_duration'))->groupBy('video_event','video_user','video_name','video_duration')->where('video_event', '=', 'video second played')->orderByDesc('count')->get();
        $video=DB::table('upload_videos')->select('upload_name')->get();

        return view('SortedVideos',['howmany'=>$howmany,'howmanyU'=>$howmanyU,'video'=>$video]);
    }

    public function SortedUsers()
    {
        //$firstVid=DB::table('upload_videos')->select('*')->first();
        $howmany = DB::table('info_videos')->select(DB::raw('DISTINCT video_user,COUNT(*) as count,video_event'))->groupBy('video_event','video_user')->where('video_event', '=', 'video second played')->orderByDesc('count')->get();
        $howmanyV = DB::table('info_videos')->select(DB::raw('DISTINCT video_name, video_user,COUNT(*) as count,video_event,COUNT(video_user) as countV,video_duration'))->groupBy('video_event','video_user','video_name','video_duration')->where('video_event', '=', 'video second played')->orderByDesc('count')->get();
        $video=DB::table('upload_videos')->select('upload_name')->get();
        // $howmanyM=floor($howmany/60);
        //$howmanyS=$howmany%60;

        return view('SortedUsers',['howmany'=>$howmany,'howmanyV'=>$howmanyV,'video'=>$video]);
    }


    public function UserSelection(Request $req)
    {
        request()->validate([
            'username1' => 'required|different:username2',
            'username2' => 'required|different:username1',
            'videoName' =>   'required'
        ]);
        $username1 = $req->input('username1');
        $username2 = $req->input('username2');
        $video=$req->input('videoName');
        $video=substr($video,0,-4);
        $videoRange2=DB::table('info_videos')->select('video_duration')->where('video_name','=',$video)->first();
        $videoRange=$videoRange2->video_duration;
        //session(['Uname1'=>$username1]);
        //session(['Uname2'=>$username2]);

        $playA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video play')->where('video_name',$video)->get()->count();
        $playB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video play')->where('video_name',$video)->get()->count();

        $pausedA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video paused')->where('video_name',$video)->get()->count();
        $pausedB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video paused')->where('video_name',$video)->get()->count();

        $stopA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video stop')->where('video_name',$video)->get()->count();
        $stopB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video stop')->where('video_name',$video)->get()->count();


        $restartA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video restart')->where('video_name',$video)->get()->count();
        $restartB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video restart')->where('video_name',$video)->get()->count();

        $endedA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video ended')->where('video_name',$video)->get()->count();
        $endedB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video ended')->where('video_name',$video)->get()->count();

        $seekedfA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video seeking forward')->where('video_name',$video)->get()->count();
        $seekedfB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video seeking forward')->where('video_name',$video)->get()->count();

        $seekedbA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username1)->where('video_event','=','video seeking backward')->where('video_name',$video)->get()->count();
        $seekedbB=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=',$username2)->where('video_event','=','video seeking backward')->where('video_name',$video)->get()->count();


        $playedsecA=DB::table('info_videos')->select(DB::raw('DISTINCT video_current_timeStart,COUNT(*) as count,video_duration, video_user'))->groupBy('video_current_timeStart','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=',$username1)->where('video_name',$video)->get();
        $playedsecB=DB::table('info_videos')->select(DB::raw('DISTINCT video_current_timeStart,COUNT(*) as count,video_duration, video_user'))->groupBy('video_current_timeStart','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=',$username2)->where('video_name',$video)->get();

        $playedsecA1=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress,COUNT(*) as count,video_duration, video_user'))->groupBy('video_progress','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=',$username1)->where('video_name',$video)->get();
        $playedsecB1=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress,COUNT(*) as count,video_duration, video_user'))->groupBy('video_progress','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=',$username2)->where('video_name',$video)->get();

        $playedsecA5=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress5,COUNT(*) as count,video_duration, video_user'))->groupBy('video_progress5','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=',$username1)->where('video_name',$video)->get();
        $playedsecB5=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress5,COUNT(*) as count,video_duration, video_user'))->groupBy('video_progress5','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=',$username2)->where('video_name',$video)->get();


        $lava = new Lavacharts;
        $video_data  = \Lava::DataTable();
        $video_data->addStringColumn('Events')
            ->addNumberColumn($username1)
            ->addNumberColumn($username2)
            ->addRow(['Play',  $playA,$playB])
            ->addRow(['Paused',  $pausedA,$pausedB])
            ->addRow(['Stopped',  $stopA,$stopB])
            ->addRow(['Restarted',  $restartA,$restartB])
            ->addRow(['Ended',  $endedA,$endedB])
            ->addRow(['Seeked forward',  $seekedfA,$seekedfB])
            ->addRow(['Seeked backward',  $seekedbA,$seekedbB]);

        \Lava::ColumnChart('Events', $video_data,[
            'title' => 'Events times happened',
            'legend' => [
                'position' => 'none'
            ],
            'hAxis' => [
                'title' => 'Event type'
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ]
        ]);

        //------------------other chart

        $video_data2  = \Lava::DataTable();
        $video_data2->addNumberColumn('Progress %');
        $video_data2->addNumberColumn('Played Second '.$username1);


            foreach($playedsecA1 as $p){
            $video_data2->addRow([$p->video_progress,$p->count]);
            }

        \Lava::ScatterChart('Progress of '.$username1.' on Played Seconds', $video_data2,[
            'hAxis' => [
                'title' => 'Progress %'
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ],
            'height'=>600,
            'width' => 1000,
            'title' => 'Progress of '.$username1.' on Played Seconds',
            'legend' => [
                'position' => 'none'
            ]
        ]);
        //------------------other chart similar
        $video_data3  = \Lava::DataTable();
        $video_data3->addNumberColumn('Progress %');
        $video_data3->addNumberColumn('Played Second '.$username2);

        foreach($playedsecB1 as $p){
            $video_data3->addRow([$p->video_progress,$p->count]);
        }

        \Lava::ScatterChart('Progress of '.$username2.' on Played Seconds', $video_data3,[
            'hAxis' => [
                'title' => 'Progress %'
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ],
            'height'=>600,
            'width' => 1000,
            'title' => 'Progress of '.$username2.' on Played Seconds',
            'legend' => [
                'position' => 'none'
            ]
        ]);

        return view('CUchart',['videoRange'=>$videoRange,'video'=>$video,'playedsecA'=>$playedsecA,'playedsecB'=>$playedsecB,'username1'=>$username1,'username2'=>$username2,'playedsecA1'=>$playedsecA1,'playedsecB1'=>$playedsecB1,'playedsecA5'=>$playedsecA5,'playedsecB5'=>$playedsecB5]);
    }

    public function chartUser(Request $req)
    {
        request()->validate([
            'videoName' =>   'required'
        ]);
        $video=$req->input('videoName');
        $video=substr($video,0,-4);
        $videoRange2=DB::table('info_videos')->select('video_duration')->where('video_name','=',$video)->first();
        $videoRange=$videoRange2->video_duration;

        $username = session('Uname');

        $playA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video play')->where('video_name',$video)->get()->count();

        $pausedA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video paused')->where('video_name',$video)->get()->count();

        $stopA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video stop')->where('video_name',$video)->get()->count();

        $restartA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video restart')->where('video_name',$video)->get()->count();

        $endedA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video ended')->where('video_name',$video)->get()->count();

        $seekedfA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video seeking forward')->where('video_name',$video)->get()->count();

        $seekedbA=DB::table('info_videos')->select('video_event','video_user')->where('video_user','=', $username)->where('video_event','=','video seeking backward')->where('video_name',$video)->get()->count();

        $playedsecA=DB::table('info_videos')->select(DB::raw('DISTINCT video_current_timeStart,COUNT(*) as count,video_duration,video_user'))->groupBy('video_current_timeStart','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=', $username)->where('video_name',$video)->get();

        $playedsecA1=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress,COUNT(*) as count,video_duration,video_user'))->groupBy('video_progress','video_duration','video_user')->where('video_event','=','video second played')->where('video_user','=', $username)->where('video_name',$video)->get();

        $playedsecA5=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress5,COUNT(*) as count,video_duration,video_user'))->groupBy('video_duration','video_user','video_progress5')->where('video_event','=','video second played')->where('video_user','=', $username)->where('video_name',$video)->get();


        $lava = new Lavacharts;
        $video_data  = \Lava::DataTable();
        $video_data->addStringColumn('Events')
            ->addNumberColumn('Count ' .$username)
            ->addRow(['Play',  $playA])
            ->addRow(['Paused',  $pausedA])
            ->addRow(['Stopped',  $stopA])
            ->addRow(['Restarted',  $restartA])
            ->addRow(['Ended',  $endedA])
            ->addRow(['Seeked forward',  $seekedfA])
            ->addRow(['Seeked backward',  $seekedbA]);



        \Lava::ColumnChart('Events', $video_data,[
            'title' => 'Events times happened',
            'legend' => [
                'position' => 'none'
            ],
            'hAxis' => [
                'title' => 'Event type'
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ]
        ]);

        //------------------other chart

        $video_data2  = \Lava::DataTable();
        $video_data2->addNumberColumn('Progress %');
        $video_data2->addNumberColumn('Played Second '. $username);


        foreach($playedsecA1 as $p){
            $video_data2->addRow([$p->video_progress,$p->count]);
        }


        \Lava::ScatterChart('Progress of '. $username.' on Played Seconds', $video_data2,[
            'hAxis' => [
                'title' => 'Progress %'
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ],
            'height'=>600,
            'width' => 1000,
            'title' => 'Progress of '. $username.' on Played Seconds',
            'legend' => [
                'position' => 'none'
            ]
        ]);

        return view('Uchart',['videoRange'=>$videoRange,'video'=>$video,'playedsecA'=>$playedsecA,'username'=>$username,'playedsecA5'=>$playedsecA5,'playedsecA1'=>$playedsecA1]);
    }

    public function VideosHeatmap(Request $req)
    {
        $usernameF=$req->input('video');
        $username=substr($usernameF,0,-4);
        $req->session()->put('VideoHeat', $username);

        $playA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video play')->get()->count();

        $pausedA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video paused')->get()->count();

        $stopA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video stop')->get()->count();

        $restartA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video restart')->get()->count();

        $endedA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video ended')->get()->count();

        $seekedfA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video seeking forward')->get()->count();

        $seekedbA=DB::table('info_videos')->select('video_event','video_name')->where('video_name','=', $username)->where('video_event','=','video seeking backward')->get()->count();

        $playedsecA=DB::table('info_videos')->select(DB::raw('DISTINCT video_current_timeStart,COUNT(*) as count,video_progress,video_duration,video_name'))->groupBy('video_current_timeStart','video_progress','video_duration','video_name')->where('video_event','=','video second played')->where('video_name','=', $username)->get();

        $playedsecA1=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress,COUNT(*) as count,video_duration,video_name'))->groupBy('video_progress','video_duration','video_name')->where('video_event','=','video second played')->where('video_name','=', $username)->get();

        $playedsecA5=DB::table('info_videos')->select(DB::raw('DISTINCT video_progress5,COUNT(*) as count,video_duration,video_name'))->groupBy('video_duration','video_name','video_progress5')->where('video_event','=','video second played')->where('video_event','=','video second played')->where('video_name','=', $username)->get();

        $rangeVid=DB::table('info_videos')->select('video_duration')->where('video_name','=', $username)->first();


        $lava = new Lavacharts;
        $video_data  = \Lava::DataTable();
        $video_data->addStringColumn('Events')
            ->addNumberColumn('Count ' .$username)
            ->addRow(['Play',  $playA])
            ->addRow(['Paused',  $pausedA])
            ->addRow(['Stopped',  $stopA])
            ->addRow(['Restarted',  $restartA])
            ->addRow(['Ended',  $endedA])
            ->addRow(['Seeked forward',  $seekedfA])
            ->addRow(['Seeked backward',  $seekedbA]);



        \Lava::ColumnChart('Events', $video_data,[
            'title' => 'Events times happened',
            'legend' => [
                'position' => 'none'
            ],
            'hAxis' => [
                'title' => 'Event type'
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ]
        ]);

        //------------------other chart

        $video_data2  = \Lava::DataTable();
        $video_data2->addNumberColumn('Progress %');
        $video_data2->addNumberColumn('Played Second '. $username);


        foreach($playedsecA1 as $p){
            $video_data2->addRow([$p->video_progress,$p->count]);
        }


        \Lava::ScatterChart('Progress of '. $username.' on Played Seconds', $video_data2,[
            'hAxis' => [
                'title' => 'Progress %',
            ],
            'vAxis' => [
                'title' => 'Times (count)'
            ],
            'height'=>600,
            'width' => 1000,
            'title' => 'Progress of '. $username.' on Played Seconds',
            'legend' => [
                'position' => 'none'
            ]

        ]);


        return view('VideosHeatmap',['playedsecA'=>$playedsecA,'username'=>$username,'playedsecA1'=>$playedsecA1,'playedsecA5'=>$playedsecA5,'rangeVid'=>$rangeVid]);
    }

    public function UserSession(Request $req)
    {
        $video_user=$req->Qusername;
        DB::table('users')->where('username',$video_user)->increment('user_session');
    }
}
