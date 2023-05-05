<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ExportDataTable.php
 * User: ${USER}
 * Date: 02.${MONTH_NAME_FULL}.2023
 * Time: 08:41
 */

namespace App\Http\Livewire\Backend;

use App\Exports\LagerExport;
use App\Models\Backend\Lager\Lager;
use Livewire\Component;
use Maatwebsite\Excel\Excel;

class ExportDataTable extends Component
{
    public $selected = [];

    public function render()
    {
        $lagers = Lager::latest()->get();

        return view('livewire.backend.export-data-table', compact('lagers'));
    }

    public function exportToCsv()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new LagerExport($this->selected))->download('lager_tasks_'.date('d-m-Y').'_'.now()->toTimeString().'.csv', Excel::CSV);
    }

    public function isArrayEmpty()
    {
        if ($this->selected) {
            return false;
        }

        session()->flash('error', 'Bitte wählen Sie mindestens eine Zeile zum Exportieren aus');

        return true;
    }

    public function exportToPdf()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new LagerExport($this->selected))->download('lager_tasks_'.date('d-m-Y').'_'.now()->toTimeString().'.pdf', Excel::DOMPDF);
    }

    public function exportToXls()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new LagerExport($this->selected))->download('lager_tasks_'.date('d-m-Y').'_'.now()->toTimeString().'.xlsx');
    }
}
