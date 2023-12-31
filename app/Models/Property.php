<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Auth;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    public function property_state(){
        return $this->belongsTo(State::class,'state','id');
    }

}
