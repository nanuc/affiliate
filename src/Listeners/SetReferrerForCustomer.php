<?php

namespace Nanuc\Affiliate\Listeners;

use Nanuc\Affiliate\Events\CustomerCreated;

class SetReferrerForCustomer
{
    public function handle(CustomerCreated $event)
    {
        $cookieName = config('affiliate.cookie.name');

        if(request()->hasCookie($cookieName)) {
            $userModel = config('auth.providers.users.model');
            if($user = $userModel::firstWhere('affiliate_tag', request()->cookie($cookieName))) {
                $event->customer->update([
                    'affiliate_referred_by' => $user->id,
                ]);
            }
        }
    }
}
