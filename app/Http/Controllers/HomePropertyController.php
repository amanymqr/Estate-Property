<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Property;
use App\Models\MultiImage;
use Illuminate\Http\Request;

class HomePropertyController extends Controller
{
    public function PropertyDetails($id, $slug)
    {
        $property = Property::findOrFail($id);
        $multiImage = MultiImage::where('property_id',$id)->get();
        $amenities = $property->amenities_id;
        $property_amen = explode(',',$amenities);
        $facility = Facility::where('property_id',$id)->get();
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id',$type_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.property.property_details', compact('property' , 'multiImage' , 'property_amen' , 'facility' , 'relatedProperty'));
    }
}
