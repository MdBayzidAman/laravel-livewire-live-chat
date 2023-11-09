<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Fouladgar\MobileVerification\Contracts\MustVerifyMobile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureMobileIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null): mixed
    {
        $user = auth()->user();

        if (! $user || ($user instanceof MustVerifyMobile && ! $user->hasVerifiedMobile()) && $user->mobile) {
            return $request->expectsJson()
                ? abort(403, __('MobileVerification::mobile_verifier.not_verified'))
                : Redirect::guest(URL::route($redirectToRoute ?: 'mobile.verification.notice'));
                // : redirect('/')->withErrors(['mobile' => __('MobileVerification::mobile_verifier.not_verified')]);
        }

        return $next($request);
    }
}
