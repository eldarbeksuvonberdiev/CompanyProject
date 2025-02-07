<?php

namespace App\Http\Controllers;

use App\Models\DeliveryNote;
use App\Http\Controllers\Controller;
use App\Imports\DeliveryNoteImport;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouse.deliveryNotes.index', compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required',
            'file' => 'required'
        ]);
        $rows = Excel::toCollection(new DeliveryNoteImport, $request->file('file'));
        dd($rows);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryNote $deliveryNote)
    {
        //
    }
}
