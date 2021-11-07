<?php
/**
 * Created by PhpStorm.
 * User: Par
 * Date: 24-Nov-18
 * Time: 11:52 AM
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class Student
{
    public function handle($request, Closure $next)
    {
        $name=Session::get('Uname');
        $role='Student';
        $find=DB::table('users')->select('role')->where('username',$name)->where('role',$role)->exists();
        if (!$find)
        {
            return redirect('/VideoDisplay')->withErrors($name."  Student only may enter");
        }
        return $next($request);
    }
}