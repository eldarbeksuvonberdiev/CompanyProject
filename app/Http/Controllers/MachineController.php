<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = Machine::all();
        return view('production.machine.index', compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        Machine::create($data);

        return back()->with([
            'status' => 'success',
            'message' => 'Machine has been created successfully!',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $machine->update($data);

        return back()->with([
            'status' => 'success',
            'message' => 'Machine has been updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Machine has been updated successfully!',
        ]);
    }


    public function status(Machine $machine)
    {
        if ($machine->status == 1) {
            $machine->update(['status' => 0]);
        } else {
            $machine->update(['status' => 1]);
        }

        return back()->with([
            'status' => 'success',
            'message' => "$machine->name status has been changed!"
        ]);
    }
}
