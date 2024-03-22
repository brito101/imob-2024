<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function index(Request $request)
    {
        $cookie = filter_var($request->cookie, 513);

        Cookie::set('cookieConsent', $cookie, (12 * 43200));  // 1 year

        if ($cookie == 'accept') {
            $json['gtmHead'] = view('site._partials.gtm-head')->render();
            $json['gtmBody'] = view('site._partials.gtm-body')->render();
        }

        $json['cookie'] = true;
        return \response()->json($json);
    }
}
