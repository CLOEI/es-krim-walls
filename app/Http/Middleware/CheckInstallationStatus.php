<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class CheckInstallationStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $config = json_decode(File::get(base_path('config.json')), true);

        if ($config['installed']) {
            return redirect('/login')->with('error', 'Registration is not allowed.');
        }

        return $next($request);
    }
}
