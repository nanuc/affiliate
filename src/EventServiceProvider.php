<?php

namespace Nanuc\Affiliate;

use Nanuc\Affiliate\Events\CustomerCreated;
use Nanuc\Affiliate\Events\ReceiptCreated;
use Nanuc\Affiliate\Listeners\CalculateCommission;
use Nanuc\Affiliate\Listeners\SetReferrerForCustomer;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        CustomerCreated::class => [
            SetReferrerForCustomer::class,
        ],
        ReceiptCreated::class => [
            CalculateCommission::class,
        ],
    ];
}
