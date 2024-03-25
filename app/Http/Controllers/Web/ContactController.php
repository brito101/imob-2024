<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\Property;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function send(Request $request)
    {

        $property = Property::find($request->property_id);

        $data = $request->all();
        $data['user_id'] = $property->user_id;
        $data['agency_id'] = $property->agency_id;
        $data['step_id'] = Step::orderBy('sequence', 'asc')->first()->id;
        $client = Client::create($data);

        if ($client->save()) {
            $contact = new ClientContact();
            $contact->client_id = $client->id;
            $contact->property_id = $property->id;
            $contact->message = Str::limit($request->message);
            $contact->save();
        }
    }
}
