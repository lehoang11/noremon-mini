<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Auth;
use Backend;
class AdminMiddleware
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
        if(Auth::check() && Backend::isAdmin()) {

            return $next($request);
        }
        abort(401, "Trang bạn truy cập không tồn tại");
    }
}
