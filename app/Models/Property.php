<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'headline', 'cover', 'type_id', 'experience_id', 'goal', 'status', 'owner',
        'sale_price', 'rent_price', 'condominium', 'description',
        //ok
        'bedrooms',
        'suites', 'bathrooms', 'rooms', 'garage', 'garage_covered', 'area_total', 'area_util',
        'zipcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city', 'views', 'user_id', 'agency_id', 'client_id',
    ];

    /** Relationships */
    public function differentials()
    {
        return $this->hasMany(PropertyDifferentials::class);
    }
}
