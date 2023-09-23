<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonial = Testimonial::latest()->get();
        return view('backend_admin.testimonial.all_testimonial', compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend_admin.testimonial.add_testimonial');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
        $save_url = 'upload/testimonial/' . $name_gen;

        Testimonial::insert([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
        ]);
        return redirect()->route('testimonial.index')
            ->with('message', 'Testimonial Inserted Successfully')
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
        $testimonial = Testimonial::findOrFail($id);
        return view('backend_admin.testimonial.edit_testimonial', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
        ];

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if (File::exists($testimonial->image)) {
                File::delete($testimonial->image);
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
            $data['image'] = 'upload/testimonial/' . $name_gen;
        }
        $testimonial->update($data);
        return redirect()->route('testimonial.index')
            ->with('message', 'Testimonial Updated Successfully')
            ->with('alert-type', 'success');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $img = $testimonial->image;
        unlink($img);

        Testimonial::findOrFail($id)->delete();

        return redirect()->back()->with('message', 'Testimonial Deleted Successfully')
            ->with('alert-type', 'success');
    }
}
