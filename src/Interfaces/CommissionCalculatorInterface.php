<?php

namespace Nanuc\Affiliate\Interfaces;

use Nanuc\Affiliate\Models\Receipt;

interface CommissionCalculatorInterface
{
    public function calculate(Receipt $receipt);
}