<?php

namespace App\Models\Views;

use App\Models\ClientContact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients_view';

    protected $appends = [
        'created_at_pt'
    ];

    public function getCreatedAtPtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getProperty()
    {
        $contact = ClientContact::where('client_id', $this->id)->first();
        if ($contact) {
            $property = Property::find($contact->property_id);
            if ($property) {
                return $property->title;
            }
            return null;
        }
        return null;
    }
}
