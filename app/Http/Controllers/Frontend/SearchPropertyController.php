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

    public function AllPropertySeach(Request $request)
    {
//fillter rent page
        $property_status = $request->property_status;
        $stype = $request->ptype_id;
        $sstate = $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;

        $property = Property::where('status', '1')->where('bedrooms', $bedrooms)->where('bathrooms', 'like', '%' . $bathrooms . '%')->where('property_status', $property_status)
            ->with('propertyType', 'property_state')
            ->whereHas('property_state', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('propertyType', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })
            ->get();

        return view('frontend.property.property_search', compact('property'));
    }
}
