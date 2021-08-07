<?php

namespace Nanuc\Affiliate;

use Illuminate\Contracts\Http\Kernel;
use Laravel\Paddle\Cashier;
use Nanuc\Affiliate\Commands\InitiatePayouts;
use Nanuc\Affiliate\Http\Middleware\SetAffiliateCookie;
use Nanuc\Affiliate\Models\Customer;
use Nanuc\Affiliate\Models\Receipt;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AffiliateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('affiliate')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasTranslations()
            ->hasCommand(InitiatePayouts::class);

        $this->app->make(Kernel::class)
            ->prependMiddleware(SetAffiliateCookie::class);

        Cashier::useCustomerModel(Customer::class);
        Cashier::useReceiptModel(Receipt::class);

        $this->app->register(EventServiceProvider::class);
    }
}
