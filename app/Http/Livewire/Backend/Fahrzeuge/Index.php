<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2023
 * Time: 08:01
 */

namespace App\Http\Livewire\Backend\Fahrzeuge;

use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //    public $fahrzeuges;

    public $search = '';

    public $herstellers;

    public $sortField = 'id';

    public $sortDirection = 'asc';

    public $selectedHersteller = '';

    public function create()
    {
        return redirect(route('backend.fahrzeuge.create'));
    }

    public function edit(Fahrzeuges $id)
    {
        return redirect(route('backend.fahrzeuge.edit', $id->slug));
    }

    public function show(Fahrzeuges $id)
    {
        return redirect(route('backend.fahrzeuge.show', $id->slug));
    }

    public function destroy(Fahrzeuges $fahrzeuge)
    {
        session()->flash('success', 'Das Fahrzeug wurde gelöscht.');
        $fahrzeuge->delete();
    }

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

    public function render()
    {
        $hersteller = [];
        $fahrzeuge = Fahrzeuges::whereLike(['fz_hersteller', 'fz_model', 'fz_type', 'fz_hsn', 'fz_tsn', 'fz_kennzeichen', 'kunden.kd_vorname', 'kunden.kd_name', 'kunden.kd_kundennummer', 'kunden.kd_ort', 'kunden.kd_plz'], $this->search)
            ->when($this->selectedHersteller, function ($query) {
                return $query->where('fz_hersteller', $this->selectedHersteller);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);
        $fahrzeuge->hersteller = Fahrzeuges::select('fz_hersteller')->groupBy('fz_hersteller')->get();

        return view('livewire.backend.fahrzeuge.index', ['fahrzeuges' => $fahrzeuge]);
    }
}
