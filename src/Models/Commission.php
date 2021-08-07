<?php

namespace Nanuc\Affiliate\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'affiliate_commissions';

    protected $guarded = [];

    public function user()
    {
        $userModel = config('auth.providers.users.model');
        return $this->belongsTo($userModel, 'user_id');
    }
}
