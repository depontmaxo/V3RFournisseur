<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usager;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        //dd(Auth::user());        
        if (!Auth::user())
        {
            //return redirect()->route('Connexion.connexion');
        }   
        else if (Auth::user()->role== 'responsable' || Auth::user()->role== 'commis' || Auth::user()->role== 'admin' )
        {
            return $next($request);
        }        
        else if (Auth::user()->neq != null || Auth::user()->email != null)
        {
            return $next($request);
        }
        
        abort(403);
    }

}
