<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\MachineProduction;
use App\Models\Product;
use App\Models\Production;
use App\Models\User;
use Illuminate\Http\Request;

class ProductionController extends Controller
{


    public function index()
    {
        $productions = Production::with('machineProductions')->get();
        $machines = Machine::all();
        $users = User::all();
        $products = Product::all();
        return view('production.production.index', compact('productions', 'machines', 'users', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product' => 'required|exists:products,id',
            'count' => 'required|integer',
            'production' => 'required|array'
        ]);

        $production = Production::create([
            'product_id' => $data['product'],
            'count' => $data['count'],
        ]);

        foreach ($data['production'] as $key => $value) {
            MachineProduction::create([
                'production_id' => $production->id,
                'machine_id' => $value['id'],
                'user_id' => $value['user'],
                'count' => $production->count,
            ]);
        }

        return back()->with([
            'status' => 'success',
            'message' => 'Production has been given successfully!'
        ]);
    }
}
