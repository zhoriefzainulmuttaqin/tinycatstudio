<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckClientSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->guard('client')->user();

        if ($user) {
            // Check OTP activation first
            if (is_null($user->email_verified_at)) {
                if (!$request->routeIs('client.verify-otp.*') && !$request->routeIs('filament.client.auth.logout')) {
                    return redirect()->route('client.verify-otp.show');
                }
            } else {
                if (!$user->is_active) {
                    auth()->guard('client')->logout();
                    return redirect()->route('filament.client.auth.login')->withErrors([
                        'data.email' => 'Your account has been suspended. Please contact support.'
                    ]);
                }

                if ($user->valid_until && $user->valid_until->endOfDay()->isPast()) {
                    auth()->guard('client')->logout();
                    return redirect()->route('filament.client.auth.login')->withErrors([
                        'data.email' => 'Your subscription expired on ' . $user->valid_until->format('d M Y') . '. Please renew to continue.'
                    ]);
                }
            }
        }

        return $next($request);
    }
}
