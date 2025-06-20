<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (in_array($request->user()->role,$roles)){
            return $next($request);
        }
        if ($request->user()->role == 1){
            return redirect()->route('homeUser');
        }
        elseif($request->user()->role == 2){
            return redirect()->route('home');
        }
        elseif($request->user()->role == 3){
            return redirect()->route('pertanahan');
        }
        elseif($request->user()->role == 4){
            return redirect()->route('dukcapil');
        }
        elseif($request->user()->role == 5){
            return redirect()->route('home');
        }
        elseif($request->user()->role == 6){
            return redirect()->route('home');
        }
        elseif($request->user()->role == 7){
            return redirect()->route('home');
        }
        elseif($request->user()->role == 8){
            return redirect()->route('home');
        }
        // else{
        //     return redirect()->route('/home');
        // }
        // return redirect('/home');
    }
}
