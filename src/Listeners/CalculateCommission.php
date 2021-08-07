<?php

namespace Nanuc\Affiliate\Listeners;

use Illuminate\Support\Arr;
use Nanuc\Affiliate\Events\ReceiptCreated;
use Nanuc\Affiliate\Models\Commission;

class CalculateCommission
{
    public function handle(ReceiptCreated $event)
    {
        $calculatorClass = config('affiliate.commission.calculator');
        $commissions = (new $calculatorClass)->calculate($event->receipt);

        foreach(Arr::wrap($commissions) as $commission) {
            $event->receipt->commissions()->save(new Commission([
                'user_id' => $commission->user->id,
                'amount' => $commission->amount,
                'currency' => $commission->currency,
            ]));
        }

    }
}
