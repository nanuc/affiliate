# Payment additions to Laravel Spark
This package send mail to the frontend of Laravel aps. This is useful for demos on landing pages.

## Installation
Install the package:
```
composer require nanuc/payments
```

Add the middleware `Nanuc\Affiliate\Http\Middleware\SetAffiliateCookie` to all routes that are supposed to be targeted for afilliation.

Run
```
php artisan vendor:publish --tag=affiliate-migrations
php artisan migrate
```

Publish the config optionally
```
php artisan vendor:publish --tag=affiliate-config
```

## Tag generation
Per default the tag is a random string with 6 characters. You can set the length in the config value `affiliate.tags.length` or in `.env`:
```
AFFILIATE_TAGS_LENGTH=8
```
You can get full control over the tag generation process by creating a class that implements `Nanuc\Affiliate\Interfaces\TagGeneratorInterface`. The only method `generate` receives the user and must return a string. You set this class in the config at `affiliate.tags.generator`.


## Commission calculation
Per default the commission is just a share of the receipt amount. You can set the amount in the config value `affiliate.commission.percentage` or in `.env`:
```
AFFILIATE_COMMISSION_PERCENTAGE=25
```
You can get full control over the calculation process by creating a class that implements `Nanuc\Affiliate\Interfaces\CommissionCalculatorInterface`. The only method `calculate` receives a receipt and must return an array of `Nanuc\Affiliate\CommissionData`. You set this class in the config at `affiliate.commission.calculator`.   

## Initiate payouts
Put the following in your Kernel with the interval you want to run your payouts:
```
protected function schedule(Schedule $schedule)
{
    $schedule->command('affiliate:initiate-payouts')->monthly();
}
```

You can get full control over the payout process by creating a class that implements `Nanuc\Affiliate\Interfaces\PayoutsHandlerInterface`. You set this class in the config at `affiliate.payouts.handler`.

The class must have three methods: `willBePaid`, `handle` and `finish`. The default class will pay any user that has commissions larger than $20 and write a csv file into storage.
You can set the minimum payout amount in `affiliate.payouts.min-amount` or `AFFILIATE_PAYOUTS_MIN_AMOUNT`.

## GUI
Authenticated users can find the dashboard at `/affiliate`. You can change the route in the config file.

You can use a view component that creates a link to the affiliate route:
```
<x-affiliate::nav-link />
<x-affiliate::nav-link-responsive />
```

You can publish the texts with `php artisan vendor:publish --tag=affiliate-translations`.