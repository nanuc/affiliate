<?php

namespace Nanuc\Affiliate\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Nanuc\Affiliate\Models\Receipt;

class ReceiptCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Receipt $receipt
    ) {}
}
