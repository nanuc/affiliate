<?php

namespace Nanuc\Affiliate\Models;

use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $table = 'affiliate_payouts';

    protected $guarded = [];

    public function user()
    {
        $userModel = config('auth.providers.users.model');
        return $this->belongsTo($userModel);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'affiliate_payout_id');
    }
}
