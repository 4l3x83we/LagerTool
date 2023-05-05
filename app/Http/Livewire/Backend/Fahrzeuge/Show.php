<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 09:30
 */

namespace App\Http\Livewire\Backend\Fahrzeuge;

use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use App\Models\Backend\Kunden\Kundens;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $fahrzeug;

    public $pages = [];

    public $kunde;

    public $hu;

    public $kat;

    public $plakette;

    public $reifens = [];

    public function mount($id)
    {
        $this->fahrzeug = Fahrzeuges::where('slug', '=', $id)->first();
        $this->kunde = Kundens::find($this->fahrzeug->kunden_id);
        $this->hu = Carbon::parse($this->fahrzeug->fz_hu);

    }

    public function render()
    {
        return view('livewire.backend.fahrzeuge.show');
    }
}
