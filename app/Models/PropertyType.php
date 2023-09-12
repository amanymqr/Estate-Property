<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyType extends Model
{
    use HasFactory;
    protected $guarded=[];


    // public function propety()
    // {
    //     $this->hasMany(Property::class);
    // }
}
