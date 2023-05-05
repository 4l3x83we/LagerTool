<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 28.${MONTH_NAME_FULL}.2023
 * Time: 12:41
 */

namespace App\Http\Livewire\Backend\Lager;

use App\Exports\LagerExport;
use App\Models\Backend\Lager\Lager;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $selected = [];

    public $sortField = 'la_bestand';

    public $sortDirection = 'desc';

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function swapSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function create()
    {
        return redirect(route('backend.artikel.create'));
    }

    public function edit($artikel)
    {
        return redirect(route('backend.artikel.edit', $artikel));
    }

    public function show($artikel)
    {
        return redirect(route('backend.artikel.show', $artikel));
    }

    public function print($artikel)
    {
        return redirect(route('backend.lager.print', $artikel));
    }

    public function render()
    {
        $lagers = Lager::whereLike(['artikels.art_nr', 'artikels.art_name', 'la_lagerort'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('la_lagerfuehrung', '=', true)
            ->paginate(50);

        return view('livewire.backend.lager.index', ['lagers' => $lagers]);
    }

    public function exportToCsv()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new LagerExport($this->selected))->download('lager_'.date('d-m-Y').'_'.now()->toTimeString().'.csv', Excel::CSV);
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

        return (new LagerExport($this->selected))->download('lager_'.date('d-m-Y').'_'.now()->toTimeString().'.pdf', Excel::DOMPDF);
    }

    public function exportToXls()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new LagerExport($this->selected))->download('lager_'.date('d-m-Y').'_'.now()->toTimeString().'.xlsx');
    }
}
