<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentPropertyTypeController extends Controller
{
    public function PropertyType($id){
        $property = Property::where('status','1')->where('ptype_id',$id)->get();
        $property_bread = PropertyType::where('id',$id)->first();
        return view('frontend.property.property_type',compact('property','property_bread'));

    }
}
