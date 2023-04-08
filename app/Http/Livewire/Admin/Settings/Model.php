<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Model.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 14:45
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Hersteller;
use App\Models\Admin\Models;
use Livewire\Component;

class Model extends Component
{
    public $models;

    public $herstellers;

    public $herstellerID;

    public $md_name;

    public $hersteller_id;

    public $selected_id;

    public $count;

    public $updateMode = false;

    public $amount = 15;

    public function load()
    {
        $this->amount += 15;
    }

    public function render()
    {
        $pages = [[['text' => 'Model', 'link' => '']]];
        $this->herstellers = Hersteller::orderBy('hr_name', 'asc')->with('models')->withCount('models')->get();
        $this->countModels = Models::count();

        return view('livewire.admin.settings.model', ['pages' => $pages]);
    }

    public function store()
    {
        $this->validate([
            'md_name' => 'required',
            'hersteller_id' => 'required',
        ], [
            'md_name.required' => 'Bitte gib ein Model ein.',
            'hersteller_id.required' => 'Bitte wähle ein Fahrzeug aus.',
        ]);

        Models::create([
            'hersteller_id' => $this->hersteller_id,
            'md_name' => $this->md_name,
        ]);

        $this->resetInput();
        session()->flash('success', $this->md_name.' wurde erfolgreich hinzugefügt.');
    }

    private function resetInput()
    {
        $this->md_name = null;
    }

    public function edit($id)
    {
        $record = Models::with('hersteller')->findOrFail($id);
        $this->selected_id = $id;
        $this->hersteller_id = $record->hersteller_id;
        $this->md_name = $record->md_name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'md_name' => 'required',
            'hersteller_id' => 'required',
        ]);
        if ($this->selected_id) {
            $record = Models::find($this->selected_id);
            $record->update([
                'hersteller_id' => $this->hersteller_id,
                'md_name' => $this->md_name,
            ]);

            $this->resetInput();
            session()->flash('success', $this->md_name.' wurde erfolgreich geändert.');
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Models::where('id', $id);
            $record->delete();
        }
    }
}
