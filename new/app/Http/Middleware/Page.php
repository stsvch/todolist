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

        // Проверяем, была ли установлена cookie с посещенными страницами
        $visitedPages = json_decode($request->cookie('visited_pages'), true) ?? [];

        // Добавляем текущий URL в массив посещенных страниц
        $visitedPages[$request->url()] = now();

        // Устанавливаем cookie с обновленным списком посещенных страниц
        $response->cookie('visited_pages', json_encode($visitedPages));

        return $response;
    }
}
