<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Hersteller.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 12:19
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Hersteller as HerstellerModel;
use Livewire\Component;
use Livewire\WithPagination;

class Hersteller extends Component
{
    use WithPagination;

    public $herstellers;

    public $hr_name;

    public $selected_id;

    public $updateMode = false;

    public $amount = 15;

    public function store()
    {
        $this->validate([
            'hr_name' => 'required',
        ]);

        try {
            HerstellerModel::create([
                'hr_name' => $this->hr_name,
            ]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                session()->flash('error', 'Der Folgende Eintrag: <span class="text-dark">'.$this->hr_name.'</span> existiert bereits in unserer Datenbank.');
            }
        }

        $this->resetInput();
    }

    private function resetInput()
    {
        $this->hr_name = null;
    }

    public function load()
    {
        $this->amount += 15;
    }

    public function edit($id)
    {
        $record = HerstellerModel::findOrFail($id);
        $this->selected_id = $id;
        $this->hr_name = $record->hr_name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'hr_name' => 'required',
        ]);
        if ($this->selected_id) {
            $record = HerstellerModel::find($this->selected_id);
            $record->update([
                'hr_name' => $this->hr_name,
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = HerstellerModel::where('id', $id);
            $record->delete();
        }
    }

    public function render()
    {
        $pages = [[['text' => 'Manufacturer', 'link' => '']]];
        $this->herstellers = HerstellerModel::orderBy('hr_name')->get();

        return view('livewire.admin.settings.hersteller', ['pages' => $pages]);
    }
}
