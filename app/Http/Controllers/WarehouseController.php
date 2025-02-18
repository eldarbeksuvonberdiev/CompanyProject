<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequests\WarehouseStoreRequest;
use App\Http\Requests\WarehouseRequests\WarehouseUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('hr.warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('hr.warehouse.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseStoreRequest $warehouseStoreRequest)
    {
        Warehouse::create($warehouseStoreRequest->validated());

        return redirect()->route('hr.warehouse.index')->with([
            'status' => 'success',
            'message' => 'Warehouse has been successfully created!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function status(Warehouse $warehouse)
    {
        if ($warehouse->status == 1) {
            $warehouse->update(['status' => 0]);
        } else {
            $warehouse->update(['status' => 1]);
        }
        return back()->with([
            'status' => 'success',
            'message' => "$warehouse->name status has been changed!"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        $users = User::all();
        return view('hr.warehouse.edit', compact('warehouse', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseUpdateRequest $warehouseUpdateRequest, Warehouse $warehouse)
    {
        $warehouse->update($warehouseUpdateRequest->validated());
        return redirect()->route('hr.warehouse.index')->with([
            'status' => 'warning',
            'message' => 'Warehouse has been successfully updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('hr.warehouse.index')->with([
            'status' => 'danger',
            'message' => 'Warehouse has been successfully deleted!',
        ]);
    }

    public function products(Warehouse $warehouse)
    {
        $warehouses = Warehouse::where('status', 1)->where('id', '!=', $warehouse->id)->get();
        return view('hr.warehouse.products', compact('warehouse', 'warehouses'));
    }
}
