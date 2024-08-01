<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clan;    
use Symfony\Component\HttpFoundation\Response;

class ClanOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clan = Clan::findOrFail($request->clan);

        if (!$clan->users->contains(Auth::user())) {
            return redirect('dashboard');
        }

        return $next($request);
    }
}
