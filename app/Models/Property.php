<?php

namespace App\Models;

use DeepCopy\Matcher\PropertyTypeMatcher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'headline', 'cover', 'type_id', 'experience_id', 'goal', 'status', 'owner', 'client_id',
        'sale_price', 'rent_price', 'condominium', 'description',
        'rooms', 'bedrooms', 'suites', 'bathrooms', 'garage', 'garage_covered', 'area_total', 'area_util',
        'zipcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city',
        'video', 'views', 'user_id', 'agency_id',
    ];

    /** Relationships */
    public function differentials()
    {
        return $this->hasMany(PropertyDifferentials::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /** Accessors */

    public function getSalePriceAttribute($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    public function getRentPriceAttribute($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    public function getCondominiumAttribute($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    /** Scopes */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'Disponível');
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 'Indisponível');
    }

    public function scopeSale($query)
    {
        return $query->where('goal', 'Venda')->orWhere('goal', 'Venda ou Locação');
    }

    public function scopeRent($query)
    {
        return $query->where('goal', 'Locação')->orWhere('goal', 'Venda ou Locação');
    }
}
