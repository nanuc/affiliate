<?php

return [
    'cookie' => [
        'name' => 'AffiliateReferredBy',
        // Lifetime in minutes
        'lifetime' => 60 * 24 * 60,
    ],
    'referral' => [
        'parameter' => 'via',
    ],
    'tags' => [
        'generator' => \Nanuc\Affiliate\TagGenerator::class,
        'length' => env('AFFILIATE_TAGS_LENGTH', 6),
    ],
    'commission' => [
        'calculator' => \Nanuc\Affiliate\CommissionCalculator::class,
        'percentage' => env('AFFILIATE_COMMISSION_PERCENTAGE', 25),
    ],
    'payouts' => [
        'handler' => \Nanuc\Affiliate\PayoutsHandler::class,
        'min-amount' => env('AFFILIATE_PAYOUTS_MIN_AMOUNT', 20),
    ],
    'gui' => [
        'route' => 'affiliate',
        'stats' => [
            'color' => env('AFFILIATE_GUI_STATS_COLOR', 'green-500'),
        ],
        'paypal' => [
            'color' => env('AFFILIATE_GUI_PAYPAL_COLOR', 'green'),
        ]
    ],
];