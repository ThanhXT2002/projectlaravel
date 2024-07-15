<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,): Response
    {
        if(Auth::id()==null){
            return redirect()->route('auth.admin')->with('error', 'Bạn phải đăng nhập để sủ dụng chức năng này!');
        }

        $user = Auth::user();

        if ($user->publish !==2) {
            abort(403, 'không có quyền truy cập.');
        }

        return $next($request);
    }
}
