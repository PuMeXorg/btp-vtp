<?php

namespace App\Http\Controllers;

use App\Helpers\RegionHelper;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function setBySlug(Request $request, string $region)
    {
        $this->applyRegion($region);

        return redirect($request->query('redirect', $request->header('referer', '/')));
    }

    public function set(Request $request)
    {
        $this->applyRegion($request->input('region'));

        $redirect = $request->input('redirect', $request->header('referer', '/'));

        return redirect($redirect);
    }

    private function applyRegion(?string $slug): void
    {
        if ($slug === 'default' || $slug === null || $slug === '') {
            RegionHelper::clear();
        } else {
            RegionHelper::set($slug);
        }
    }
}
