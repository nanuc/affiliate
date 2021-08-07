<?php

namespace Nanuc\Affiliate;


class CommissionData
{
    public function __construct(
        public $user,
        public $amount,
        public $currency,
    ) {}

}
