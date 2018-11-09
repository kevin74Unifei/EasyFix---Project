<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use Closure;

class CheckUserAdmin
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
        if(Auth::check()){           
           $user = Auth::user();
           if($user['user_perfil']!="Administrador"){
               return redirect('/');
           }           
        }else{
           return redirect('/'); 
        }
                
        return $next($request);
    }
}
