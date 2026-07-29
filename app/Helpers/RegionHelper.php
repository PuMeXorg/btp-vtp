<?php

namespace App\Helpers;

use App\Models\Region;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class RegionHelper
{
    public static function current(): ?Region
    {
        $slug = Session::get('region');
        if (!$slug) return null;
        return Cache::remember('region_' . $slug, 3600, fn() =>
            Region::where('slug', $slug)->where('is_active', true)->first()
        );
    }

    public static function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember('regions_all', 3600, fn() => Region::active()->get());
    }

    public static function set(string $slug): void
    {
        $region = Region::where('slug', $slug)->where('is_active', true)->first();
        if ($region) Session::put('region', $slug);
    }

    public static function clear(): void { Session::forget('region'); }

    public static function phone(): string
    {
        return static::current()?->phone_display
            ?? Setting::get('default_phone', '+7 (000) 000-00-00');
    }

    public static function email(): string
    {
        return static::current()?->email
            ?? Setting::get('default_email', 'region@vtp-inz.ru');
    }

    public static function address(): string
    {
        return static::current()?->address
            ?? Setting::get('default_address', '');
    }

    public static function workingHours(): string
    {
        return static::current()?->working_hours
            ?? Setting::get('working_hours', 'Пн-пт: 09:00–18:00');
    }

    public static function name(): string
    {
        return static::current()?->name ?? '';
    }
}
