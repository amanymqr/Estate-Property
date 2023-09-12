<?php

namespace App\Models;

use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }

    // public function amenities()
    // {
    //     return $this->belongsToMany(Amenity::class, 'property_amenities', 'property_id', 'amenity_id');
    // }
}
