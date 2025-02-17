<?php

namespace App\Http\Controllers;

use App\Models\WarehouseMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequests\WarehouseMaterialTransferRequest;
use App\Models\Material;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseMaterialController extends Controller
{
    public function transfer(WarehouseMaterialTransferRequest $warehouseMaterialTransferRequest, Material $material)
    {

        $materialTo = WarehouseMaterial::firstOrCreate(
            [
                'warehouse_id' => $warehouseMaterialTransferRequest->to_id,
                'material_id' => $material->id,
            ],
            [
                'value' => 0
            ]
        );

        $materialFrom = WarehouseMaterial::where('warehouse_id', $warehouseMaterialTransferRequest->from_id)->where('material_id', $material->id)->first();

        if ($materialFrom->value < $warehouseMaterialTransferRequest->amount) {
            return back()->with([
                'status' => 'danger',
                'message' => 'The inserted amount is greater than the amount in the warehouse itself',
            ]);
        }



        // WarehouseMaterial::createOrUpdate([
        //     'warehouse_id' => $warehouseMaterialTransferRequest->to_id,
        //     'material_id' => $warehouseMaterial->id
        // ], [
        //     'value' => $materialTo->value + $warehouseMaterialTransferRequest->amount
        // ]);

        $materialTo->update([
            'value' => $materialTo->value + $warehouseMaterialTransferRequest->amount
        ]);

        $materialFrom->update([
            'value' => $materialFrom->value - $warehouseMaterialTransferRequest->amount
        ]);

        return redirect()->route('hr.warehouse.index')->with([
            'status' => 'success',
            'message' => 'The transfer has been done successfully!',
        ]);
    }
}
