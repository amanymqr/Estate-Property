<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\Facility;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\PropertMessage;
use Illuminate\Support\Facades\Auth;

class HomePropertyController extends Controller
{
    public function PropertyDetails($id, $slug)
    {
        $property = Property::findOrFail($id);
        $multiImage = MultiImage::where('property_id', $id)->get();
        $amenities = $property->amenities_id;
        $property_amen = explode(',', $amenities);
        $facility = Facility::where('property_id', $id)->get();
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amen', 'facility', 'relatedProperty'));
    }



    public function PropertyMessage(Request $request)
    {
        $property_id = $request->property_id;
        $agent_id = $request->agent_id;
        if (Auth::check()) {
            PropertMessage::insert([
                'user_id' => Auth::user()->id,
                'agent_id' => $agent_id,
                'property_id' => $property_id,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->back()->with('message', 'Send Message Successfully')
                ->with('alert-type', 'success');
        } else {
            return redirect()->back()->with('message', 'Plz Login Your Account First')
                ->with('alert-type', 'error');
        }
    }


    //front blog
    public function BlogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);
        $blog_category = BlogCategory::latest()->get();
        $blog_post = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_details', compact('blog', 'tags_all', 'blog_category', 'blog_post'));
    }

    public function BlogCategoryList($id){
        $blog = BlogPost::where('blogcat_id',$id)->get();
        $bread_category = BlogCategory::where('id',$id)->first();
        $category = BlogCategory::latest()->get();
        $blog_post = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_category_list', compact('blog','bread_category','category','blog_post'));
    }

    public function BlogList(){
        $blog = BlogPost::latest()->get();
        $blog_category = BlogCategory::latest()->get();
        $blog_post = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_list', compact('blog','blog_category','blog_post'));
    }
}
