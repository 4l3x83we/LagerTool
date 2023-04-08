<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Warengruppe.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 11:38
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Warengruppe as WarengruppeModel;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

class Warengruppe extends Component
{
    public $warengruppes;

    public $wg_name;

    public $wg_slug;

    public $wg_parent_id;

    public $selected_id;

    public $updateMode = false;

    public $amount = 15;

    public function load()
    {
        $this->amount += 15;
    }

    public function render()
    {
        $this->warengruppes = WarengruppeModel::whereNull('wg_parent_id')->with('subWarengruppe')->orderBy('wg_name', 'asc')->take($this->amount)->get();

        $pages = [[['text' => 'Goods Group', 'link' => '']]];

        return view('livewire.admin.settings.warengruppe', ['pages' => $pages]);
    }

    public function store()
    {
        $this->validate([
            'wg_name' => 'required',
            'wg_parent_id' => 'required|numeric',
        ]);

        WarengruppeModel::create([
            'wg_name' => $this->wg_name,
            'wg_slug' => SlugService::createSlug(WarengruppeModel::class, 'wg_slug', $this->wg_name),
            'wg_parent_id' => $this->wg_parent_id,
        ]);
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->wg_name = null;
        $this->wg_parent_id = null;
    }

    public function edit($id)
    {
        $record = WarengruppeModel::findOrFail($id);
        $this->selected_id = $id;
        $this->wg_name = $record->wg_name;
        $this->wg_parent_id = $record->wg_parent_id;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'wg_name' => 'required',
            'wg_parent_id' => 'required|numeric',
        ]);

        $slugName = WarengruppeModel::where('id', $this->selected_id)->first()->wg_slug;

        $slug = ($this->wg_name === $slugName) ? $slugName : SlugService::createSlug(WarengruppeModel::class, 'wg_slug', $this->wg_name);

        if ($this->selected_id) {
            $record = WarengruppeModel::find($this->selected_id);
            $record->update([
                'wg_name' => $this->wg_name,
                'wg_slug' => $slug,
                'wg_parent_id' => $this->wg_parent_id,
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = WarengruppeModel::where('id', $id);
            $record->delete();
        }
    }
}
