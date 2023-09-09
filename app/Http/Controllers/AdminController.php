<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        return redirect()->back()->with('message', 'Admin Profile Updated successfully')->with('alert-type', 'success');
    }


    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request)
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

        return redirect()->back()->with('message', 'Admin Password Updated Successfuly!')->with('alert-type', 'info');
    }
}
