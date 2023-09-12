<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Amenities;
use App\Models\MultiImage;
use Illuminate\Support\Str;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $property = Property::latest()->get();
        return view('backend_admin.property.all_property', compact('property'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend_admin.property.add_property', compact('propertyType', 'amenities', 'activeAgent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'property_name' => 'required|string|max:255',
        ]);
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        // dd($amenites);
        $pcode = IdGenerator::generate([
            'table' => 'properties',
            'field' => 'property_code',
            'length' => 5,
            'prefix' => 'PC'
        ]);        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $thambnail_url = 'upload/property/thambnail/' . $name_gen;
        // $image->move('upload/property/thambnail/', $name_gen);
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode, //PC9hT4
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thambnail' => $thambnail_url,
            'created_at' => Carbon::now(),
        ]);

        /// Multiple Image Upload From Here ////
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $multiImg_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $multiImg_name);
            $uploadPath = 'upload/property/multi-image/' . $multiImg_name;
            $img->move('upload/property/multi-image/', $multiImg_name);

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => now(), // Carbon::now() or now() can be used for the current timestamp
            ]);
        }

        /// Facilities ////
        $facilities = Count($request->facility_name);
        if ($facilities != NULL) {
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        return redirect()->route('property.index')->with('message', 'Property  added successfully')
            ->with('alert-type', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
