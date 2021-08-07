<?php

namespace Nanuc\Affiliate;

class Affiliate
{
    public static function personalLink($user)
    {
        return url('/') . '?' . config('affiliate.referral.parameter') . '=' . self::getTag($user);
    }

    public static function getTag($user)
    {
        if(!$user->affiliate_tag) {
            $tagGeneratorClass = config('affiliate.tags.generator');
            $generator = new $tagGeneratorClass;
            $user->update([
                'affiliate_tag' => $generator->generate($user),
            ]);
        }

        return $user->affiliate_tag;
    }
}
