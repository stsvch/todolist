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
        $visitedPages = $request->cookie('visited_pages', '');
        $visitedPagesArray = $visitedPages ? explode(',', $visitedPages) : [];
        $currentPage = $request->path();
        if (!in_array($currentPage, $visitedPagesArray)) {
            $visitedPagesArray[] = $currentPage;
        }
        $visitedPagesString = implode(',', $visitedPagesArray);

        $response = $next($request);
        $response->withCookie(cookie('visited_pages', $visitedPagesString,0));
        return $response;
    }
}

