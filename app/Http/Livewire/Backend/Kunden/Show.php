<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 09:20
 */

namespace App\Http\Livewire\Backend\Kunden;

use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use App\Models\Backend\Kunden\Kundens;
use Livewire\Component;

class Show extends Component
{
    public $kunde;

    public $fahrzeuges;

    public $reifens = [];

    public function showFahrzeug(Fahrzeuges $id)
    {
        return redirect(route('backend.fahrzeuge.show', $id->slug));
    }

    public function mount($id)
    {
        $this->kunde = Kundens::where('slug', '=', $id)->first();
        $this->fahrzeuges = Fahrzeuges::where('kunden_id', '=', $this->kunde->id)->get();
    }

    public function render()
    {
        return view('livewire.backend.kunden.show');
    }
}
