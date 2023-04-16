<?php

namespace App\Services;

use App\Models\Count;
use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkService
{
    public static function increment($user_id, $link_id, $ip_address, $type = 'Link')
    {
        return Cache::remember('connect-' . $link_id, 3600, function () use ($user_id, $link_id, $ip_address, $type) {
            $count = Count::create([
                'user_id' => $user_id,
                'ip_address' => $ip_address,
                'foreign_key_id' => $link_id,
                'type' => $type,
                'date' => date('Y-m-d')
            ]);

            return $count;
        });
    }
}
