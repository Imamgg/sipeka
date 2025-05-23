<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */  public function handle(Request $request, Closure $next, string $role): Response
  {
    if (!Auth::check()) {
      return redirect()->route('login');
    }

    $user = Auth::user();

    // Direct check instead of calling hasRole
    if ($user->role !== $role) {
      $roleName = ucfirst($role);
      return redirect()->route('login')->with('error', "Unauthorized access. Please login as {$roleName}.");
    }

    return $next($request);
  }
}
