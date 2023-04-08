<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Emissionsklasse.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 06:54
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Emissionsklasse as EmissionsklasseModel;
use Livewire\Component;

class Emissionsklasse extends Component
{
    public $emissionsklassen;

    public $emissionsklasse;

    public $kat_id;

    public $selected_id;

    public $amount = 15;

    public function store(): void
    {
        $this->validate([
            'emissionsklasse' => 'required',
        ], [
            'emissionsklasse.required' => 'Bitte gib die Emissionsklasse an',
        ]);

        EmissionsklasseModel::create([
            'emissionsklasse' => $this->emissionsklasse,
            'kat_id' => $this->kat_id,
        ]);
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->emissionsklasse = null;
        $this->kat_id = null;
    }

    public function destroy($id): void
    {
        if ($id) {
            $emissionsklasse = EmissionsklasseModel::where('id', $id);
            $emissionsklasse->delete();
        }
    }

    public function load()
    {
        $this->amount += 15;
    }

    public function render()
    {
        $pages = [[['text' => 'Emission Class', 'link' => '']]];
        $this->emissionsklassen = EmissionsklasseModel::orderBy('emissionsklasse', 'asc')->get();

        return view('livewire.admin.settings.emissionsklasse', ['pages' => $pages]);
    }
}
