<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ServerStatus;
use Illuminate\Support\Facades\Auth;

class ServerStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if server is online
        if (!ServerStatus::isOnline()) {
            // If user is authenticated, check if they are admin
            if (Auth::check()) {
                $user = Auth::user();

                // Only allow admins to continue when server is offline
                if ($user->role !== 'admin') {
                    // Logout non-admin users
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('login')->with('maintenance', true);
                }
            } else {
                // If not authenticated and trying to access protected routes, redirect to login
                if (!$request->routeIs('login') && !$request->routeIs('password.*')) {
                    return redirect()->route('login')->with('maintenance', true);
                }
            }
        }

        return $next($request);
    }
}
