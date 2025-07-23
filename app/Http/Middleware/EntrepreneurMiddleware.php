<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepreneurMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role === 'entrepreneur_approuve') {
            return $next($request);
        }
        if ($user && $user->role === 'entrepreneur_en_attente') {
            return redirect()->route('attente.validation');
        }
        abort(403, 'Accès réservé aux entrepreneurs approuvés');
    }
}
