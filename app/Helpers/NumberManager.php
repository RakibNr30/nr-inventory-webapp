<?php

namespace App\Helpers;

use Modules\Ums\Entities\User;

class NumberManager
{
    // number short form
    public static function shortFormat( $n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }

    // campaign follower counter
    public static function campaignFollowerCount($campaign) {
        $counter = 0;
        foreach ($campaign->campaignInfluencers as $campaignInfluencer) {
            $influencer = $campaignInfluencer->user;

            if ($campaignInfluencer->accept_status == 1 && $campaignInfluencer->campaign_accept_status_by_influencer) {
                $counter += ($influencer->socialAccountInfo->instagram_followers + $influencer->socialAccountInfo->tiktok_followers);
            }
        }

        return $counter;
    }

    // campaign uploaded content counter
    public static function campaignUploadedContentCount($campaign) {
        $counter = 0;
        foreach ($campaign->campaignInfluencers as $campaignInfluencer) {
            $counter += ($campaignInfluencer->is_content_uploaded);
        }

        return $counter;
    }
}
