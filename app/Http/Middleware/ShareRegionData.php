<?php

namespace App\Http\Middleware;

use App\Helpers\RegionHelper;
use App\Models\Page;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareRegionData
{
    public function handle(Request $request, Closure $next)
    {
        View::share('currentRegion',  RegionHelper::current());
        View::share('allRegions',     RegionHelper::all());
        View::share('regionPhone',    RegionHelper::phone());
        View::share('regionEmail',    RegionHelper::email());
        View::share('regionAddress',  RegionHelper::address());
        View::share('regionHours',    RegionHelper::workingHours());
        View::share('regionName',     RegionHelper::name());

        $allTopServices = Page::active()->where('type', 'service')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->with('children.children')
            ->get();

        View::share('menuServices', $allTopServices->filter(fn($p) => !str_starts_with($p->slug, 'proektir'))->values());
        View::share('menuProektirovanie', $allTopServices->filter(fn($p) => str_starts_with($p->slug, 'proektir'))->values());
        View::share('menuCatalog',
            Page::active()->where('type', 'catalog')
                ->whereNull('parent_id')
                ->orderBy('sort')
                ->with('children')
                ->get()
        );

        View::share('siteName',      Setting::get('site_name', 'Компания'));
        View::share('footerText',    Setting::get('footer_text', ''));
        View::share('yandexMetrika', Setting::get('yandex_metrika', ''));

        return $next($request);
    }
}
