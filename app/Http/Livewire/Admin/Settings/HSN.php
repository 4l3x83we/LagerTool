<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: HSN.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 02:13
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Hersteller;
use App\Models\Admin\HSN as HSNS;
use Illuminate\Database\QueryException;
use Livewire\Component;

class HSN extends Component
{
    public $herstellers;

    public $hsns;

    public $hsn;

    public $hersteller_id;

    public $hr_name;

    public $selected_id;

    public $updateMode = false;

    public function store()
    {
        $this->validate([
            'hsn' => 'required',
        ]);

        try {
            HSNS::create([
                'hersteller_id' => $this->hersteller_id,
                'hsn' => $this->hsn,
            ]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) {
                session()->flash('error', 'Der folgende Eintrag: <span class="text-dark">'.$this->hsn.'</span> existiert bereits in unserer Datenbank.');
            }
        }

        session()->flash('HSN wurde dem Hersteller zugewiesen');
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->hsn = null;
//        $this->hersteller_id = null;
    }

    public function edit($id)
    {
        $hsn = HSNS::findOrFail($id);
        $this->selected_id = $hsn->id;
        $this->hersteller_id = $hsn->hersteller_id;
        $this->hsn = $hsn->hsn;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'hsn' => 'required',
        ]);

        if ($this->selected_id) {
            $hsn = HSNS::find($this->selected_id);
            $hsn->update([
                'hersteller_id' => $this->hersteller_id,
                'hsn' => $this->hsn,
            ]);
        }

        session()->flash('HSN wurde dem geändert und dem richtigen Hersteller zugewiesen');
        $this->resetInput();
        $this->updateMode = false;
    }

    public function destroy($id)
    {
        if ($id) {
            $hsn = HSNS::find($id);
            $hsn->delete();
        }
        session()->flash('HSN wurde gelöscht');
    }

    public function render()
    {
        $this->herstellers = Hersteller::orderBy('hr_name')->get();
        $this->hsns = HSNS::with('hersteller')->orderBy('hsn')->get();

        return view('livewire.admin.settings.h-s-n');
    }
}
