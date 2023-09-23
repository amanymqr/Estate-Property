<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = BlogPost::latest()->get();
        return view('backend_admin.post.all_post', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogcat = BlogCategory::latest()->get();
        return view('backend_admin.post.add_post', compact('blogcat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('post.index')->with('message', 'BlogCategory Inserted Successfully')
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
        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);
        return view('backend_admin.post.edit_post', compact('post', 'blogcat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post_id = $request->id;

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;
        } else {
            $save_url = BlogPost::findOrFail($post_id)->post_image;
        }

        BlogPost::findOrFail($post_id)->update([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('all.post')->with('message', 'BlogPost Updated Successfully')
        ->with('alert-type', 'success');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'BlogPost Deleted Successfully')
            ->with('alert-type', 'success');
    }
}
