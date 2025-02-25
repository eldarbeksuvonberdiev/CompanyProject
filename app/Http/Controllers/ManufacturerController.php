<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MachineProduction;
use App\Models\Production;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{

    public function index()
    {
        $userProductions = MachineProduction::where('user_id', 1)->orderBy('status')->get()->groupBy('status');
        return view('livewire.manufacturer.manufacturer-component', compact('userProductions'));
    }

    public function start(MachineProduction $machineProduction, Production $production)
    {
        $production->status = 1;
        $production->save();

        $machineProduction->status = 1;
        $machineProduction->save();

        return back()->with([
            'status' => 'success',
            'message' => 'Production has been started'
        ]);
    }

    public function inProgress(Request $request,MachineProduction $machineProduction, Production $production)
    {
        $pCount = $production->machineProductions()->count();
        $pGivenCount = $production->machineProductions()->where('status', 0)->count();
        $pInProgressCount = $production->machineProductions()->where('status', 1)->count();
        $pDoneCount = $production->machineProductions()->where('status', 2)->count();

        
    }
}
