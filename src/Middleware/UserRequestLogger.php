<?php

namespace Pandoux\LaravelUserRequestLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pandoux\LaravelUserRequestLogger\Models\UserRequest;

class UserRequestLogger
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
        if(Auth::check())
        {
            $user_request = new UserRequest;

            $user_request->user_id = Auth::user();
            $user_request->url = $request->url();
            $user_request->route = $request->route()->getName();
            $user_request->method = $request->method();
            $user_request->content = $request->all();
            
            $user_request->ip = $request->ip();
            $user_request->user_agent = $request->userAgent();
            $user_request->is_ajax = $request->ajax();
            $user_request->is_https = $request->secure();
        }

        return $next($request);
    }
}
