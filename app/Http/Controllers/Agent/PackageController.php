<?php

namespace App\Http\Controllers\Agent;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

    public function BuyPackage()
    {
        return view('agent.package.buy_package');
    }
    public function BuyBusinessPlan()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('agent.package.business_plan', compact('id', 'user'));
    }
    public function StoreBusinessPlan(Request $request)
    {
        $id = Auth::user()->id;
        $uid = User::findOrFail($id);
        $nid = $uid->credits;

        Package::insert([

            'user_id' => $id,
            'package_name' => 'Business',
            'package_credits' => '3',
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => '20',
            'created_at' => Carbon::now(),
        ]);

        // User::where('id', $id)->update([
        //     'credits' => DB::raw('3 + ' . $nid),
        // ]);

        User::where('id', $id)->update([
            // 'credits' => DB::raw('credits + 3'),
            'credits' => DB::raw('3 + ' . $nid),
        ]);
        return redirect()->route('agent_property.index')->with('message', 'You have purchase Basic Package Successfully')
            ->with('alert-type', 'success');
    }

    public function BuyProfessionalPlan()
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('agent.package.professional_plan', compact('data'));
    }

    public function StoreProfessionalPlan(Request $request)
    {

        $id = Auth::user()->id;
        $uid = User::findOrFail($id);
        $nid = $uid->credits;

        Package::insert([

            'user_id' => $id,
            'package_name' => 'Professional',
            'package_credits' => '10',
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => '50',
            'created_at' => Carbon::now(),
        ]);

        User::where('id', $id)->update([
            'credits' => DB::raw('10 + ' . $nid),
        ]);

        return redirect()->route('agent_property.index')->with('message', 'You have purchase Professional Package Successfully')
            ->with('alert-type', 'success');
    }

    public function PackageHistory()
    {
        $id = Auth::user()->id;
        $package_history = Package::where('user_id', $id)->get();
        return view('agent.package.package_history', compact('package_history'));
    }

    public function AgentPackageInvoice($id)
    {
        $packagehistory = Package::where('id',$id)->first();
        $pdf = Pdf::loadView('agent.package.package_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
