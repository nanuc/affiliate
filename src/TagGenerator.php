<?php

namespace Nanuc\Affiliate;

use Illuminate\Support\Str;
use Nanuc\Affiliate\Interfaces\TagGeneratorInterface;

class TagGenerator implements TagGeneratorInterface
{
    public function generate($user)
    {
        $userModel = config('auth.providers.users.model');
        $usedTags = $userModel::pluck('affiliate_tag');
        do {
            $tag = Str::random(config('affiliate.tags.length'));
        } while($usedTags->contains($tag));

        return $tag;
    }
}
