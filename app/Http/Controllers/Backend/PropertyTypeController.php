<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = PropertyType::latest()->get();
        return view('backend_admin.type_property.all_type', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend_admin.type_property.add_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);
        PropertyType::create($validatedData);
        return redirect()->route('propertyType.index')
            ->with('message', 'Property Type added successfully')
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
        $types = PropertyType::findOrFail($id);
        return view('backend_admin.type_property.edit_type', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        PropertyType::findOrFail($id)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        return redirect()->route('propertyType.index')
            ->with('message', 'Property Type updated successfully')
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->delete();

        return redirect()->back()
            ->with('message', 'Property Type deleted successfully')
            ->with('alert-type', 'success');
    }

}
