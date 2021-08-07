<?php

namespace Nanuc\Affiliate\Http\Controllers;

use Illuminate\Http\Request;
use Nanuc\Affiliate\Affiliate;
use Nanuc\Affiliate\Models\Commission;
use Nanuc\Affiliate\Models\Customer;

class GuiController
{
    public function show()
    {
        $commissionsForUser = Commission::where('user_id', auth()->id())->get();

        $currencyMapping = [
            'USD' => '$',
            'EUR' => '€',
        ];

        return view('affiliate::home', [
            'countReferals' => Customer::where('affiliate_referred_by', auth()->id())->count(),
            'balance' => $commissionsForUser->whereNull('affiliate_payout_id')->sum('amount') / 100,
            'paidOut' => $commissionsForUser->whereNotNull('affiliate_payout_id')->sum('amount') / 100,
            'currency' => $commissionsForUser->count() > 0 ? $currencyMapping[$commissionsForUser->first()->currency] : '',
            'statsColor' => config('affiliate.gui.stats.color'),
            'paypalColor' => config('affiliate.gui.paypal.color'),
            'personalLink' => Affiliate::personalLink(auth()->user()),
        ]);
    }

    public function storeEmail(Request $request)
    {
        auth()->user()->update([
            'affiliate_paypal_email' => $request->emailAddress,
        ]);
    }
}
