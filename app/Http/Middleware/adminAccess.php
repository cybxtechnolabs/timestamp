<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class adminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ($request->age <= 200) {
        //     return redirect('home');
        // }
        //check if loggedin user is admin 
        $user = Auth::user();
        if($user->user_type == 'admin') {
            return $next($request);
        } else {
            return redirect('');
        }
        

    }
}
