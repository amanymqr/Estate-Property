<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AgentController extends Controller
{
    public function AgentDashboard()
    {
        $agent = Auth::user();
        $numProperties = Property::where('agent_id', $agent->id)->count();

        return view('agent.index' , compact('numProperties'));
    }

    public function AgentLogin()
    {
        return view('agent.agent_login');
    }

    public function AgentRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::AGENT);
    }

    public function AgentLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/agent/login')->with('message', 'Agent Logout successfully')->with('alert-type', 'success');
    }

    public function AgentProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('agent.agent_profile', compact('profileData'));
    }

    public function AgentProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/agent_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        return redirect()->back()->with('message', 'agent Profile Updated successfully')->with('alert-type', 'success');
    }

    public function AgentChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('agent.agent_change_password', compact('profileData'));
    }

    public function AgentUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //match old password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->with('message', 'Agent OLd Password Does not Match!')->with('alert-type', 'error');
        }
        //update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('message', 'Agent Password Updated Successfuly!')->with('alert-type', 'info');
    }
}
