<?php

namespace App\Http\Controllers;

use App\Models\WarehouseMaterial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseMaterialController extends Controller
{
    public function transfer(Request $request, WarehouseMaterial $warehouseMaterial)
    {
        dd($request->all(), $warehouseMaterial);
    }
}
