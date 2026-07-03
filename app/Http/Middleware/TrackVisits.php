<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests that are not AJAX and not admin/dashboard
        if ($request->isMethod('GET') && !$request->ajax() && !$request->is('admin*') && !$request->is('dashboard*') && !$request->is('profile*')) {
            $ip = $request->ip();
            $userAgent = $request->userAgent();
            $today = now()->toDateString();

            // Unique check per IP, user-agent and date to count unique daily visitors
            $alreadyVisited = Visit::where('ip_address', $ip)
                ->where('user_agent', $userAgent)
                ->where('visited_date', $today)
                ->exists();

            if (!$alreadyVisited) {
                Visit::create([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'visited_date' => $today,
                ]);
            }
        }

        return $next($request);
    }
}
