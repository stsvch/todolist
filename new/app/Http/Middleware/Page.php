<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Page
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $visitedPages = $response->cookie('pages');
        if($visitedPages!="")
        {
            $visitedPages = $visitedPages.",".$request->url();
        }else{
            $visitedPages = $request->url();
        }
        $response->cookie('pages', $visitedPages);

        return $response;
    }
}
