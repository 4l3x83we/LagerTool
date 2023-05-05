<?php

namespace App\Exports;

use App\Models\Backend\Lager\Lager;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LagerExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
     * @return Collection
     */
    public function collection()
    {
        return Lager::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Artikel ID',
            'Bestand',
            'Lagerführung',
            'Min',
            'Max',
            'Lagerort',
            'Gelöscht am',
            'Erstellt am',
            'Geändert am',
        ];
    }
}
