<?php

namespace App\Http\Controllers;

use App\Helpers\RegionHelper;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function set(Request $request)
    {
        $slug = $request->input('region');

        if ($slug === 'default') {
            RegionHelper::clear();
        } else {
            RegionHelper::set($slug);
        }

        $redirect = $request->input('redirect', $request->header('referer', '/'));
        return redirect($redirect);
    }
}