<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0] ?? null;

        if ($subdomain && $tenant = Tenant::where('slug', $subdomain)->first()) {
            app()->instance('tenant', $tenant);
            return $next($request);
        }

        abort(403, 'Tenant tidak ditemukan atau langganan berakhir');
    }
}
