<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenities::latest()->get();
        return view('backend_admin.amenities.all_amenities', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend_admin.amenities.add_amenitie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amenities_name' => 'required',
        ]);
        Amenities::create($validatedData);
        return redirect()->route('amenities.index')
            ->with('message', 'Amenities  added successfully')
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
        $amenities = Amenities::findOrFail($id);
        return view('backend_admin.amenities.edit_amenities', compact('amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Amenities::findOrFail($id)->update([
            'amenities_name' => $request->amenities_name,
        ]);
        return redirect()->route('amenities.index')
            ->with('message', 'Amenities  updated successfully')
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $amenities = Amenities::findOrFail($id);
        $amenities->delete();

        return redirect()->back()
            ->with('message', 'Amenities  deleted successfully')
            ->with('alert-type', 'success');
    }
}
