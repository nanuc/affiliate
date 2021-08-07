<?php

namespace Nanuc\Affiliate\Interfaces;

use Nanuc\Affiliate\Models\Payout;

interface PayoutsHandlerInterface
{
    public function willBePaid($commissions);
    public function handle(Payout $payout);
    public function finish($payouts = []);
}