<?php

namespace Nanuc\Affiliate;

use Illuminate\Support\Facades\Storage;
use Nanuc\Affiliate\Interfaces\PayoutsHandlerInterface;
use Nanuc\Affiliate\Models\Payout;

class PayoutsHandler implements PayoutsHandlerInterface
{
    public function willBePaid($commissions)
    {
        return $commissions->sum->amount > config('affiliate.payouts.min-amount') * 100
            && filled($commissions->first()->user->affiliate_paypal_email);
    }

    public function handle(Payout $payout) {}

    public function finish($payouts = [])
    {
        if(count($payouts) == 0) {
            return;
        }

        $data = array_map(fn($payout) => [$payout->user->affiliate_paypal_email, $payout->amount], $payouts);

        $filename = 'payouts_' . strtr(now()->toDateTimeString(), [':' => '-', ' ' => '_']) . '.csv';
        $path = storage_path('app/payouts/');
        Storage::makeDirectory($path);

        $handle = fopen($path . $filename, 'w');

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }
}
