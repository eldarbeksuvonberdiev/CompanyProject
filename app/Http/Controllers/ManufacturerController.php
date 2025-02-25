<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MachineProduction;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{

    public function index()
    {
        $userProductions = MachineProduction::where('user_id', 1)->orderBy('status')->get()->groupBy('status');
        return view('livewire.manufacturer.manufacturer-component', compact('userProductions'));
    }

    public function start(MachineProduction $machineProduction)
    {
        dd($machineProduction);
    }
}
