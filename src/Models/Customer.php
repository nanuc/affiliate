<?php

namespace Nanuc\Affiliate\Models;

use Nanuc\Affiliate\Events\CustomerCreated;

class Customer extends \Laravel\Paddle\Customer
{
    protected $dispatchesEvents = [
        'created' => CustomerCreated::class,
    ];

    public function referrer()
    {
        $userModel = config('auth.providers.users.model');
        return $this->belongsTo($userModel, 'affiliate_referred_by');
    }
}
