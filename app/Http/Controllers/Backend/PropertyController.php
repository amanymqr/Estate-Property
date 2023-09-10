<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;

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
        $activeAgent = User::where('status', 'active')->where('role' , 'agent')->latest()->get();
        return view('backend_admin.property.add_property', compact('propertyType' ,'amenities' , 'activeAgent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
