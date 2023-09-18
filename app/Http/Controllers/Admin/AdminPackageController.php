<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class AdminPackageController extends Controller
{
    public function AdminPackageHistory()
    {

        $packagehistory = Package::latest()->get();
        return view('backend_admin.package.package_history', compact('packagehistory'));
    }

    public function AdminPackageInvoice($id){

        $packagehistory = Package::where('id',$id)->first();
        $pdf = Pdf::loadView('backend_admin.package.package_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }
}
