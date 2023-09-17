<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;

class ManageAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_agent = User::where('role', 'agent')->get();
        return view('backend_admin.manage_agent.all_agent', compact('all_agent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend_admin.manage_agent.add_agent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required|string|max:10',
            'address' => ' nullable',
            'password' => 'required|string|min:8',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'active',

        ]);

        return redirect()->route('manage_agent.index')->with('message', 'Agent Created successfully')
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
        $all_agent = User::findOrFail($id);

        return view('backend_admin.manage_agent.edit_agent', compact('all_agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required|string|max:10',
            'address' => 'nullable',
        ]);

        $agent = User::findOrFail($id);

        $agent->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('manage_agent.index')->with('message', 'Agent updated successfully')
            ->with('alert-type', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agent = User::findOrFail($id);
        $agent->delete();

        return redirect()->route('manage_agent.index')->with('message', 'Agent deleted successfully')
            ->with('alert-type', 'success');
    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }
}
