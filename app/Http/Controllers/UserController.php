<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }


    public function UserProfile()
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        return view('frontend.dashboard.edit_profile', compact('userData'));
    }


    public function UserProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        return redirect()->back()->with('message', 'User Profile Updated Successfully')->with('alert-type',  'success');
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', 'User logout Successfully')->with('alert-type',  'success');
    }


    public function UserChangePassword()
    {
        return view('frontend.dashboard.change_password');
    }


    public function UserUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //match old password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->with('message', 'Admin OLd Password Does not Match!')->with('alert-type', 'error');
        }
        //update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('message', 'User Password Updated Successfuly!')->with('alert-type', 'info');
    }
}
