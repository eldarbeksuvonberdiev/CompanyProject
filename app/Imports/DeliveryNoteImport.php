<?php

namespace App\Imports;

use App\Models\DeliveryNote;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeliveryNoteImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        return $rows;
    }
}
