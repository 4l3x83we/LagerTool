<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: MwSt.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 16:46
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\MwSt as MwStModel;
use Livewire\Component;

class MwSt extends Component
{
    public $mwsts;

    public $mw_name;

    public $mw_wert;

    public $selected_id;

    public $updateMode = false;

    public $amount = 15;

    public function load()
    {
        $this->amount += 15;
    }

    public function render()
    {
        $pages = [[['text' => 'VAT', 'link' => '']]];
        $this->mwsts = MwStModel::take($this->amount)->get();

        return view('livewire.admin.settings.mw-st', ['pages' => $pages]);
    }

    public function store()
    {
        $this->validate([
            'mw_name' => 'required',
            'mw_wert' => 'required|numeric',
        ], [
            'mw_name.required' => 'Bitte gib einen Namen für die MwSt an.',
            'mw_wert.required' => 'Bitte gib einen Wert für die MwSt an.',
            'mw_wert.numeric' => 'Bitte gib einen Wert ein der nur aus Zahlen und als Trennzeichen einen Punkt beinhaltet.',
        ]);

        MwStModel::create([
            'mw_name' => $this->mw_name,
            'mw_wert' => $this->mw_wert,
        ]);
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->mw_name = null;
        $this->mw_wert = null;
    }

    public function edit($id)
    {
        $record = MwStModel::findOrFail($id);
        $this->selected_id = $id;
        $this->mw_name = $record->mw_name;
        $this->mw_wert = $record->mw_wert;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'mw_name' => 'required',
            'mw_wert' => 'required|numeric',
        ]);
        if ($this->selected_id) {
            $record = MwStModel::find($this->selected_id);
            $record->update([
                'mw_name' => $this->mw_name,
                'mw_wert' => $this->mw_wert,
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = MwStModel::where('id', $id);
            $record->delete();
        }
    }
}
