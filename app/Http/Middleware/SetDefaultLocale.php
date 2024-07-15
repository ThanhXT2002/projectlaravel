<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Lấy ngôn ngữ từ session hoặc sử dụng ngôn ngữ mặc định từ cấu hình
        $locale = Session::get('app_locale', config('app.locale'));

        // Thiết lập ngôn ngữ cho ứng dụng
        App::setLocale($locale);

        // Nếu session chưa có ngôn ngữ, đặt ngôn ngữ vào session
        if (is_null(Session::get('app_locale'))) {
            Session::put('app_locale', $locale);
        }

        return $next($request);
    }
}
