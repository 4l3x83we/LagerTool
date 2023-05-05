<?php

namespace App\Imports\Admin;

use App\Models\Admin\FahrzeugDatenHersteller;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FahrzeugDatenHerstellerImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        return new FahrzeugDatenHersteller([
            'model_id' => $row['modell'],
            'hersteller_id' => $row['hersteller'],
            'fdh_hsn' => strtoupper(sprintf('%04d', $row['hsn'])),
            'fdh_tsn' => strtoupper(sprintf('%03s', $row['tsn'])),
            'fdh_type' => $row['type'],
            'fdh_kw' => $row['kw'],
            'fdh_ps' => kw_ps($row['kw'])['kw'],
            'fdh_hubraum' => $row['hubraum'],
            'fdh_kraftstoff' => $row['kraftstoff'],
        ]);
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
