<?php

namespace Nanuc\Affiliate\Commands;

use Illuminate\Console\Command;
use Nanuc\Affiliate\Models\Commission;
use Nanuc\Affiliate\Models\Payout;

class InitiatePayouts extends Command
{
    public $signature = 'affiliate:initiate-payouts';

    public $description = 'Initiate the payouts';

    public function handle()
    {
        $payoutHandlerClass = config('affiliate.payouts.handler');
        $payoutHandler = new $payoutHandlerClass;

        $payouts = [];

        Commission::with('user')
            ->whereNull('affiliate_payout_id')
            ->get()
            ->groupBy('user_id')
            ->each(function($commissions, $userId) use ($payoutHandler, &$payouts) {
                if($payoutHandler->willBePaid($commissions)) {
                    $payout = Payout::create([
                        'user_id' => $userId,
                        'amount' => $commissions->sum->amount,
                    ]);

                    Commission::whereIn('id', $commissions->pluck('id'))
                        ->update([
                            'affiliate_payout_id' => $payout->id,
                        ]);

                    $payout->load('user', 'commissions');

                    $payouts[] = $payout;

                    $payoutHandler->handle($payout);
                }
            });

        $payoutHandler->finish($payouts);
    }
}