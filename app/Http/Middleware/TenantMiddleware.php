<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $subdomain = $this->extractSubdomain($request);

        $tenant = null;

        if ($subdomain) {
            $tenant = Tenant::where('subdomain', $subdomain)
                ->where('status', 'aktif')
                ->first();
        }

        if (! $tenant) {
            abort(404, 'Tenant tidak ditemukan atau tidak aktif');
        }

        app()->instance('tenant', $tenant);

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->tenant_id !== $tenant->id) {
                $user->tenant_id = $tenant->id;
                $user->save();
            }
        }

        return $next($request);
    }

    protected function extractSubdomain(Request $request): ?string
    {
        $host = $request->getHost();
        $appHost = parse_url(config('app.url'), PHP_URL_HOST);

        if ($appHost && $host === $appHost) {
            return null;
        }

        if ($appHost && Str::endsWith($host, $appHost)) {
            $relativeHost = rtrim(substr($host, 0, -strlen($appHost)), '.');

            return $relativeHost !== '' ? $relativeHost : null;
        }

        $segments = explode('.', $host);

        return count($segments) > 2 ? $segments[0] : null;
    }
}
