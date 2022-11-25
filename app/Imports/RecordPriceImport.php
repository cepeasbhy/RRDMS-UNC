<?php

namespace App\Imports;

use App\Models\RecordPrice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RecordPriceImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RecordPrice([
            'description' => $row[1],
            'price' => $row[2],
        ]);
    }

    public function startRow():int {
        return 2;
    }
}
