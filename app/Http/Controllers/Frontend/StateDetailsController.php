<?php

namespace App\Http\Controllers\Frontend;

use App\Models\State;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateDetailsController extends Controller
{
    public function StateDetails($id)
    {

        $property = Property::where('status','1')->where('state',$id)->get();
        $state = State::where('id',$id)->first();
        return view('frontend.property.state_property',compact('property','state'));
    }
}
