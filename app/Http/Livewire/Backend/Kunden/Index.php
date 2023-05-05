<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 08:28
 */

namespace App\Http\Livewire\Backend\Kunden;

use App\Models\Backend\Kunden\Kundens;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'kd_kundennummer';

    public $sortDirection = 'asc';

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
        return redirect(route('backend.kunden.create'));
    }

    public function show(Kundens $kunde)
    {
        return redirect(route('backend.kunden.show', $kunde->slug));
    }

    public function edit(Kundens $kunden)
    {
        return redirect(route('backend.kunden.edit', $kunden->slug));
    }

    public function destroy(Kundens $kunden)
    {
        session()->flash('success', $kunden->fullname().' erfolgreich gelöscht!');
        $kunden->datenschutzerklaerungs->delete();
        $kunden->delete();
    }

    public function render()
    {
        $kundens = Kundens::whereLike(['kd_vorname', 'kd_name', 'kd_kundennummer'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        return view('livewire.backend.kunden.index', ['kundens' => $kundens]);
    }
}
