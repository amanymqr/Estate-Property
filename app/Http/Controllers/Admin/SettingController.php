<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function SiteSetting()
    {

        $sitesetting = Setting::find(1);
        return view('backend_admin.setting.site_update', compact('sitesetting'));
    } // End Method

    public function UpdateSiteSetting(Request $request)
    {
        $site_id = $request->id;
        $site_setting = Setting::findOrFail($site_id);

        $site_setting->update([
            'support_phone' => $request->support_phone,
            'company_address' => $request->company_address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright,
        ]);

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1500, 386)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;

            $site_setting->update([
                'logo' => $save_url,
            ]);
        }

        return redirect()->back()->with('message', 'SiteSetting Updated Successfully')
            ->with('alert-type', 'success');
    }
}
