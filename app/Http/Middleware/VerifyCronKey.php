<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCronKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $provided = $request->header('X-CRON-KEY');   
        $expected = env('CRON_CLEANUP_KEY');

        if (!$expected || $provided !== $expected) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
