<?php

namespace App\Http\Controllers\Agent;

use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\Package;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Amenities;
use App\Models\MultiImage;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AgentPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $properties = Property::where('agent_id', $id)->latest()->get();
        return view('agent.property.all_property', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $property_state = State::latest()->get();

        $id = Auth::user()->id;
        $property = User::where('role', 'agent')->where('id', $id)->first();
        $pcount = $property->credits;
        // dd($pcount);

        if ($pcount == 1 || $pcount == 7) {
            return redirect()->route('buy.package');
        } else {
            return view('agent.property.add_pproperty', compact('propertyType', 'amenities' ,'property_state'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $user_id = User::findOrFail($id);
        $nid = $user_id->credits;


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
        ]);
        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
        $thambnail_url = 'upload/property/thambnail/' . $name_gen;

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
            'agent_id' => Auth::user()->id,
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
        User::where('id', $id)->update([
            'credits' => DB::raw('1 + ' . $nid),
        ]);


        return redirect()->route('agent_property.index')->with('message', 'Property  added successfully')
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $multiImage = MultiImage::where('property_id', $id)->get();
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.show_property', compact('property', 'propertytype', 'amenities', 'property_ami', 'multiImage', 'facilities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::findOrFail($id);
        $multiImage = MultiImage::where('property_id', $id)->get();
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $property_state = State::latest()->get();

        // dd($property_ami);

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $facilities = Facility::where('property_id', $id)->get();

        return view('agent.property.edit_property', compact('property', 'propertyType', 'amenities',  'property_ami', 'multiImage', 'facilities' , 'property_state'))
            ->with('message', 'Property added successfully')
            ->with('alert-type', 'info');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);

        $property_id = $request->id;
        $old_img = $request->old_img;
        if ($request->hasFile('property_thambnail')) {
            $image = $request->file('property_thambnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
            $thambnail_url = 'upload/property/thambnail/' . $name_gen;

            // Delete the old thumbnail image
            if (file_exists($old_img)) {
                unlink($old_img);
            }
        } else {
            // If no new image is uploaded, retain the existing thumbnail URL
            $thambnail_url = $old_img;
        }


        $imgs = $request->multi_img;
        if (!empty($imgs)) {
            foreach ($imgs as $id => $img) {
                $imgDel = MultiImage::findOrFail($id);
                unlink($imgDel->photo_name);

                $multiImg_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $multiImg_name);
                $uploadPath = 'upload/property/multi-image/' . $multiImg_name;

                MultiImage::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        Property::findOrFail($id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
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
            'agent_id' => Auth::user()->id,
            'property_thambnail' => $thambnail_url,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('agent_property.index')->with('message', 'Property  edited successfully')
            ->with('alert-type', 'info');
    }

    public function AgentPropertyDeleteMultiImage($id, $multiId)
    {
        $multiImage = MultiImage::find($multiId);
        if (!$multiImage) {
            return redirect()->back()->with('message', 'Multi-image not found.')->with('alert-type', 'error');
        }
        if (file_exists($multiImage->photo_name)) {
            unlink($multiImage->photo_name);
        }
        $multiImage->delete();
        return redirect()->back()->with('message', 'Multi-image deleted successfully.')->with('alert-type', 'success');
    }


    public function AgentPropertyStoreNewMultiimage(Request $request)
    {

        $new_multi = $request->imageid;
        if ($request->hasFile('multi_img')) {

            $image = $request->file('multi_img');

            $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;

            MultiImage::insert([
                'property_id' => $new_multi,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        } else {
            return redirect()->back()->with('message', 'image added successfully.')->with('alert-type', 'success');
        } // End Method
    }


    public function AgentUpdatePropertyFacilities(Request $request)
    {
        $property_id = $request->id;

        if ($request->facility_name == NULL) {
            return redirect()->back();
        } else {
            // First, delete existing facilities for the property
            Facility::where('property_id', $property_id)->delete();

            // Now, insert the updated facilities
            $facilities = $request->facility_name;
            $distances = $request->distance;

            foreach ($facilities as $index => $facility) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $facility;
                $fcount->distance = $distances[$index];
                $fcount->save();
            }
        }

        return redirect()->back()->with('message', 'Facility updated successfully.')->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::findOrFail($id);
        unlink($property->property_thambnail);
        Property::findOrFail($id)->delete();
        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }
        $facilitiesData = Facility::where('property_id', $id)->get();
        foreach ($facilitiesData as $item) {
            $item->facility_name;
            Facility::where('property_id', $id)->delete();
        }
        return redirect()->back()->with('message', 'Property deleted successfully.')->with('alert-type', 'success');
    }


}
