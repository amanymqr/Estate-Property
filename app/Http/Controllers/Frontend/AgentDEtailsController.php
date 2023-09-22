<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertMessage;
use Illuminate\Support\Facades\Auth;

class AgentDEtailsController extends Controller
{
    public function AgentDetails($id)
    {
        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();
        // dd($property);
        $featured = Property::where('featured', '1')->limit(3)->get();
        $rentproperty = Property::where('property_status', 'rent')->get();
        $buyproperty = Property::where('property_status', 'buy')->get();

        return view('frontend.agent.agent_details', compact('agent', 'property', 'featured' ,'rentproperty','buyproperty'));
    }



    public function AgentDetailsMessage(Request $request)
    {

        $aid = $request->agent_id;
        if (Auth::check()) {
            PropertMessage::insert([
                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
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

    public function RentProperty(){
        $property = Property::where('status','1')->where('property_status','rent')->paginate(1);
        return view('frontend.property.rent_property',compact('property'));
    }

    public function BuyProperty(){
        $property = Property::where('status','1')->where('property_status','buy')->get();
        return view('frontend.property.buy_property',compact('property'));

    }
}
