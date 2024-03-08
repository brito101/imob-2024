<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Meta;

class ContactController extends Controller
{
    public function index()
    {

        $title = env('APP_NAME') . ' :: Contato';
        $route = route('web.contact');
        $description = 'Quer conversar com um corretor exclusivo e ter o atendimento diferenciado em busca do seu imóvel dos sonhos? '
            . 'Entre em contato com a nossa equipe!';
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

        return view('web.contact.index');
    }
}
