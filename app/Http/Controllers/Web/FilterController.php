<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Property;
use App\Models\Type;
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

    public function category(Request $request)
    {
        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->with('category')->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()->with('category')->get();
                break;
            default:
                $properties = Property::available()->with('category')->pluck();
                break;
        }

        $ids = array_unique((($properties->pluck('category'))->pluck('id'))->toArray());

        $categories = Category::whereIn('id', $ids)->orderBy('name')->pluck('name')->unique();
        
        return response()->json($categories);
    }

    public function type(Request $request)
    {
        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->with('type')->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()->with('type')->get();
                break;
            default:
                $properties = Property::available()->with('type')->pluck();
                break;
        }

        $category = Category::where('name', $request->category)->first();

        $ids = array_unique((($properties->pluck('type'))->pluck('id'))->toArray());

        $types = Type::where('category_id', $category->id)
            ->whereIn('id', $ids)->orderBy('name')->pluck('name')->unique();

        return response()->json($types);
    }

    public function city(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->where('type_id', $type->id)->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()->where('type_id', $type->id)->get();
                break;
            default:
                $properties = Property::available()->where('type_id', $type->id)->get();
                break;
        }

        $cities = array_unique(($properties->pluck('city'))->toArray());

        return response()->json($cities);
    }

    public function filter(Request $request)
    {
        $properties = Property::where(function ($query) use ($request) {
            if ($request->goal) {
                $query->where('goal', $request->goal);
            };
        });
    }
}
