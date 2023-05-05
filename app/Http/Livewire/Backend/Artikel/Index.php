<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 28.${MONTH_NAME_FULL}.2023
 * Time: 12:45
 */

namespace App\Http\Livewire\Backend\Artikel;

use App\Models\Backend\Artikel\Artikel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $sortField = 'art_name';

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

    public function destroy(Artikel $artikel)
    {
        session()->flash('error', $artikel->art_name.' erfolgreich gelöscht');
        $artikel->lagers->delete();
        $artikel->preises->delete();
        $artikel->delete();
    }

    public function render()
    {
        $artikels = Artikel::with('preises')
            ->whereLike(['art_name', 'art_ean', 'art_nr', 'art_beschreibung', 'preises.pr_brutto_vk'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        return view('livewire.backend.artikel.index', ['artikels' => $artikels]);
    }
}
