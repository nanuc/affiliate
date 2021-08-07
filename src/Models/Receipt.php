<?php

namespace Nanuc\Affiliate\Models;

use Nanuc\Affiliate\Events\ReceiptCreated;

class Receipt extends \Laravel\Paddle\Receipt
{
    protected $dispatchesEvents = [
        'created' => ReceiptCreated::class,
    ];

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
