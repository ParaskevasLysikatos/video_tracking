<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\String_;

class Lecturer
{
    public function handle($request, Closure $next)
    {
        $name=Session::get('Uname');
        $role='Lecturer';
        $find=DB::table('users')->select('role')->where('username',$name)->where('role',$role)->exists();
            if (!$find)
            {
                return redirect('/VideoDisplay')->withErrors($name."  Lecturer only may enter");
            }
        return $next($request);
    }

}
