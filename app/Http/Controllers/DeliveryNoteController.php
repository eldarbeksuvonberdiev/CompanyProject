<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Material;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use App\Models\DeliveryNote;
use Illuminate\Http\Request;
use App\Models\WarehouseMaterial;
use App\Imports\DeliveryNoteImport;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\MaterialDeliveryNote;

use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isNull;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DeliveryNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryNotes = DeliveryNote::all();
        $warehouses = Warehouse::all();
        return view('warehouse.deliveryNotes.index', compact('deliveryNotes', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'warehouse_id' => 'required',
                'file' => 'required'
            ]);

            $rows = Excel::toCollection(new DeliveryNoteImport, $request->file('file'));
            $date = Date::excelToDateTimeObject($rows[0][1][2])->format('Y-m-d');

            $deliveryNote = DeliveryNote::create([
                'company_name' => $rows[0][0][2],
                'date' => $date,
                'text' => $rows[0][2][2]
            ]);

            $i = 4;
            while (isset($rows[0][$i]) && $rows[0][$i] !== null) {
                $row = $rows[0][$i] ?? null;
                $i++;

                if (!$row || !isset($row[1])) {
                    continue;
                }

                $slug = Str::slug($row[1]);

                if ($slug) {
                    $material = Material::firstOrCreate(
                        ['slug' => $slug],
                        ['name' => $row[1]]
                    );

                    $previousValue = WarehouseMaterial::where('warehouse_id', $request->warehouse_id)
                        ->where('material_id', $material->id)
                        ->value('value') ?? 0;

                    $currentValue = $previousValue + ($row[3] ?? 0);

                    MaterialDeliveryNote::create([
                        'delivery_note_id' => $deliveryNote->id,
                        'material_id' => $material->id,
                        'unit' => $row[2] ?? null,
                        'amount' => $row[3] ?? null,
                        'price' => $row[4] ?? null,
                        'summ' => (isset($row[3], $row[4]) && is_numeric($row[3]) && is_numeric($row[4]))
                            ? $row[3] * $row[4] : 0,
                    ]);

                    WarehouseMaterial::updateOrCreate(
                        ['warehouse_id' => $request->warehouse_id, 'material_id' => $material->id],
                        ['value' => $currentValue]
                    );

                    History::create([
                        'material_id' => $material->id,
                        'type' => 1,
                        'quantity' => $row[3] ?? null,
                        'was' => $previousValue,
                        'been' => $currentValue,
                        'from_id' => $deliveryNote->id,
                        'to_id' => $request->warehouse_id
                    ]);
                }
            }

            return back()->with([
                'status' => 'success',
                'message' => 'Delivery Note has been received',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(DeliveryNote $deliveryNote)
    {
        $deliveryNoteMaterials = $deliveryNote->load('materialDeliveryNotes');
        return view('warehouse.deliveryNotes.show', compact('deliveryNoteMaterials', 'deliveryNote'));
    }
}
