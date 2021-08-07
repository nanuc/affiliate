<?php

namespace Nanuc\Affiliate\Interfaces;

use Nanuc\Affiliate\Models\Payout;

interface TagGeneratorInterface
{
    public function generate($user);
}