<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 28.${MONTH_NAME_FULL}.2023
 * Time: 12:46
 */

namespace App\Http\Livewire\Backend\Artikel;

use App\Models\Backend\Artikel\Artikel;
use Livewire\Component;

class Show extends Component
{
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::with(['warengruppes', 'lagers', 'fahrzeugDatenHerstellers'])->find($id);
    }

    public function render()
    {
        return view('livewire.backend.artikel.show');
    }
}
