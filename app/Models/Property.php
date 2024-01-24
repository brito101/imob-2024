<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'headline', 'cover', 'category_id', 'type_id', 'experience_id', 'sale', 'rent',
        'sale_price', 'rent_price', 'tribute', 'condominium', 'description', 'bedrooms',
        'suites', 'bathrooms', 'rooms', 'garage', 'garage_covered', 'area_total', 'area_util',
        'zipcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city',
        'status', 'views', 'user_id', 'agency_id', 'client_id', 'owner'
    ];

    /** Relationships */
    public function differentials()
    {
        return $this->hasMany(PropertyDifferentials::class);
    }
}
