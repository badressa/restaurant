<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Client\ClientController;
use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,string $type)
    {
        if($type=='admin' && auth()->user()->type != 'admin' ){
             abort(403);
        }
        // if($type=='client' && auth()->user()->type != 'client' ){
        //     abort(403);
        // }
        
        // if(auth()->user()->type == 'client' ){
        //     return redirect()->action([ClientController::class, 'Home']);
        // }

        return $next($request);
    }
}
