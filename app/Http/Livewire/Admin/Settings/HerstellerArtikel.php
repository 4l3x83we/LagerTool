<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: HerstellerArtikel.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 14:39
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\hersteller_artikel as HerstellerArtikelModel;
use Livewire\Component;

class HerstellerArtikel extends Component
{
    public $herstellers;

    public $ha_name;

    public $selected_id;

    public $updateMode = false;

    public $amount = 15;

    public function load()
    {
        $this->amount += 15;
    }

    public function render()
    {
        $pages = [[['text' => 'Manufacturer Item', 'link' => '']]];
        $this->herstellers = HerstellerArtikelModel::orderBy('ha_name', 'asc')->take($this->amount)->get();

        return view('livewire.admin.settings.hersteller-artikel', ['pages' => $pages]);
    }

    public function store()
    {
        $this->validate([
            'ha_name' => 'required',
        ]);

        HerstellerArtikelModel::create([
            'ha_name' => $this->ha_name,
        ]);
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->ha_name = null;
    }

    public function edit($id)
    {
        $record = HerstellerArtikelModel::findOrFail($id);
        $this->selected_id = $id;
        $this->ha_name = $record->ha_name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'ha_name' => 'required',
        ]);
        if ($this->selected_id) {
            $record = HerstellerArtikelModel::find($this->selected_id);
            $record->update([
                'ha_name' => $this->ha_name,
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = HerstellerArtikelModel::where('id', $id);
            $record->delete();
        }
    }
}
