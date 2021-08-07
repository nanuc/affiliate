<?php

namespace Nanuc\Affiliate\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SetAffiliateCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $cookieName = config('affiliate.cookie.name');
        $referralParameter = config('affiliate.referral.parameter');

        app()->resolving(EncryptCookies::class, function ($object) use ($cookieName) {
            $object->disableFor($cookieName);
        });

        if($request->has($referralParameter)) {
            Cookie::queue(Cookie::make($cookieName, $request->get($referralParameter), config('affiliate.cookie.lifetime')));
        }

        return $next($request);
    }
}
