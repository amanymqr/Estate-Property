<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchPropertyController extends Controller
{
    public function BuyPropertySeach(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search_word = $request->search;
        $search_state = $request->state;
        $search_type = $request->ptype_id;
        $property = Property::where('property_name', 'like', '%' . $search_word . '%')->where('property_status', 'buy')->with('propertyType', 'property_state')
            ->whereHas('property_state', function ($q) use ($search_state) {
                $q->where('state_name', 'like', '%' . $search_state . '%'); // anonymous function
            })
            ->whereHas('propertyType', function ($q) use ($search_type) {
                $q->where('type_name', 'like', '%' . $search_type . '%');
            })
            ->get();
        return view('frontend.property.property_search', compact('property'));
    }


    public function RentPropertySeach(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search_word = $request->search;
        $search_state = $request->state;
        $search_type = $request->ptype_id;
        $property = Property::where('property_name', 'like', '%' . $search_word . '%')->where('property_status', 'rent')->with('propertyType', 'property_state')
            ->whereHas('property_state', function ($q) use ($search_state) {
                $q->where('state_name', 'like', '%' . $search_state . '%'); // anonymous function
            })
            ->whereHas('propertyType', function ($q) use ($search_type) {
                $q->where('type_name', 'like', '%' . $search_type . '%');
            })
            ->get();
        return view('frontend.property.property_search', compact('property'));
    }
}
