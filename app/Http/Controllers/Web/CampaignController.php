<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $property = Property::where('slug', $request->slug)->with('type', 'images')->first();

        if ($property) {
            switch ($property->template) {
                case 'default':
                    return view('web.campaign.default', compact('property'));
                    break;

                default:
                    return view('web.campaign.default', compact('property'));
                    break;
            }
        } else {
            return abort(404);
        }
    }
}
