<?php

namespace Nanuc\Affiliate;


use Nanuc\Affiliate\Interfaces\CommissionCalculatorInterface;
use Nanuc\Affiliate\Models\Receipt;

class CommissionCalculator implements CommissionCalculatorInterface
{
    public function calculate(Receipt $receipt)
    {
        $referrer = $receipt->billable->customer->referrer;

        if($referrer) {
            return new CommissionData(
                amount: $receipt->amount * config('affiliate.commission.percentage'),
                currency: $receipt->currency,
                user: $referrer,
            );
        }

    }
}
