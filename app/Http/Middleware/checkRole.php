<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class checkRole
{
    public function handle($request, Closure $next)
    {
        // Log::info('checkRole middleware');
        if(Auth::check()){
            $user = DB::table("users")->where('id','=',Auth::id())->first();
            if(!$user->role == 1) {
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
