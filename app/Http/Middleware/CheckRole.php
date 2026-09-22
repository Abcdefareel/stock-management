<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userRole = Auth::User()->role;

        if ($userRole != 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini');
        }

        return $next($request);
    }
}
