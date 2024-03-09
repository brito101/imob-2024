<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Property;
use Illuminate\Http\Request;
use Meta;

class FilterController extends Controller
{
    public function sale()
    {
        $title = env('APP_NAME') . ' :: Quero Comprar';
        $route = route('web.sale');
        $description = 'Compre o imóvel dos seus sonhos na melhor e mais completa imobiliária de Espirito Santo!';
        /** Meta */
        Meta::title($title);
        Meta::set('description', $description);
        Meta::set('og:type', 'article');
        Meta::set('og:site_name', $title);
        Meta::set('og:locale', app()->getLocale());
        Meta::set('og:url', $route);
        Meta::set('twitter:url', $route);
        Meta::set('robots', 'index,follow');
        Meta::set('image', asset('img/share.png'));
        Meta::set('canonical', $route);

        $properties = Property::sale()->available()->orderBy('created_at', 'desc')->paginate(12);

        $type = 'sale';

        return view('web.filter.index', compact('properties', 'type'));
    }

    public function rent()
    {
        $title = env('APP_NAME') . ' :: Quero Alugar';
        $route = route('web.rent');
        $description = 'Alugue o imóvel dos seus sonhos na melhor e mais completa imobiliária de Espirito Santo!';
        /** Meta */
        Meta::title($title);
        Meta::set('description', $description);
        Meta::set('og:type', 'article');
        Meta::set('og:site_name', $title);
        Meta::set('og:locale', app()->getLocale());
        Meta::set('og:url', $route);
        Meta::set('twitter:url', $route);
        Meta::set('robots', 'index,follow');
        Meta::set('image', asset('img/share.png'));
        Meta::set('canonical', $route);

        $properties = Property::rent()->available()->orderBy('created_at', 'desc')->paginate(12);

        $type = 'rent';

        return view('web.filter.index', compact('properties', 'type'));
    }

    public function filter()
    {
    }

    public function experience(Request $request)
    {
        $experiences = Experience::get()->pluck('slug', 'id')->toArray();

        $ids = [];

        foreach ($experiences as $key => $value) {
            if ($value == strtolower($request->slug)) {
                $ids[] = $key;
            }
        }

        $experience = Experience::whereIn('id', $ids)->first();

        $title = env('APP_NAME') . ' :: Experiência';
        $route = route('web.rent');
        $description = 'Viva a experiência de encontrar o imóvel dos seus sonhos na melhor e mais completa imobiliária de Espirito Santo!';
        /** Meta */
        Meta::title($title);
        Meta::set('description', $description);
        Meta::set('og:type', 'article');
        Meta::set('og:site_name', $title);
        Meta::set('og:locale', app()->getLocale());
        Meta::set('og:url', $route);
        Meta::set('twitter:url', $route);
        Meta::set('robots', 'index,follow');
        Meta::set('image', asset($experience->cover) ?? asset('img/share.png'));
        Meta::set('canonical', $route);

        $properties = Property::available()->whereIn('experience_id', $ids)->orderBy('created_at', 'desc')->paginate(12);

        $type = null;

        return view('web.filter.index', compact('properties', 'type'));
    }
}
