<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyDifferentials extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'differential_id',
    ];

    /** Relationships */
    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
