<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * If maintenance mode is enabled, show maintenance page for non-admin routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Setting::get('maintenance_mode') !== '1') {
            return $next($request);
        }

        // Allow all /admin routes so admin can log in and disable maintenance
        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        return response()->view('maintenance', [], 503);
    }
}
