<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Einheiten.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 06:54
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Einheits;
use Livewire\Component;

class Einheiten extends Component
{
    public $einheitens;

    public $eh_name;

    public $selected_id;

    public $updateMode = false;

    public $amount = 15;

    public function load()
    {
        $this->amount += 15;
    }

    public function store()
    {
        $this->validate([
            'eh_name' => 'required',
        ]);

        Einheits::create([
            'eh_name' => $this->eh_name,
        ]);
        $this->resetInput();
        session()->flash('success', 'Einheit wurde angelegt');
    }

    private function resetInput()
    {
        $this->eh_name = null;
    }

    public function edit($id)
    {
        $record = Einheits::findOrFail($id);
        $this->selected_id = $id;
        $this->eh_name = $record->eh_name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'eh_name' => 'required',
        ]);
        if ($this->selected_id) {
            $record = Einheits::find($this->selected_id);
            $record->update([
                'eh_name' => $this->eh_name,
            ]);
            $this->resetInput();
            session()->flash('success', 'Einheit wurde geändert');
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Einheits::where('id', $id);
            $record->delete();
        }
        $this->resetInput();
        session()->flash('successError', 'Einheit wurde gelöscht');
        $this->updateMode = false;
    }

    public function render()
    {
        $pages = [[['text' => 'Units', 'link' => '']]];
        $this->einheitens = Einheits::take($this->amount)->get();

        return view('livewire.admin.settings.einheiten', ['pages' => $pages]);
    }
}
