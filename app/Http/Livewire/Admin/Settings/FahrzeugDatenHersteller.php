<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: FDH.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 09:21
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\FahrzeugDatenHersteller as FDH;
use App\Models\Admin\Hersteller;
use App\Models\Admin\Models;
use Livewire\Component;

class FahrzeugDatenHersteller extends Component
{
    public $fdhs;

    public $model_id;

    public $hersteller_id;

    public $fdh_hsn;

    public $fdh_tsn;

    public $fdh_type;

    public $fdh_kw;

    public $fdh_ps;

    public $fdh_hubraum;

    public $fdh_kraftstoff;

    public $amount = 15;

    public $updateMode = false;

    public $selected_id;

    public $models;

    public $herstellers;

    public $fzHersteller = null;

    protected $rules = [
        'model_id' => 'required',
        'fdh_hsn' => 'required|max:4',
        'fdh_tsn' => 'required|max:10',
        'fdh_type' => 'required',
        'fdh_kw' => 'required|numeric',
        'fdh_hubraum' => 'required|numeric',
        'fdh_kraftstoff' => 'required',
    ];

    protected $messages = [
        'model_id.required' => 'Bitte Hersteller und Model auswählen',
        'fdh_hsn.required' => 'Bitte HSN eingeben',
        'fdh_hsn.numeric' => 'Die HSN darf nur Zahlen enthalten.',
        'fdh_hsn.max' => 'Maximal 4 Zahlen',
        'fdh_tsn.required' => 'Bitte TSN eingeben',
        'fdh_tsn.max' => 'Maximal 10 Zahlen',
        'fdh_type.required' => 'Bitte gib eine Fahrzeugtype an.',
        'fdh_kw.required' => 'Bitte gib die Leistung in KW an',
        'fdh_kw.numeric' => 'Die KW dürfen nur aus Zahlen bestehen',
        'fdh_hubraum.required' => 'Bitte gib den Hubraum an',
        'fdh_hubraum.numeric' => 'Der Hubraum darf nur aus Zahlen bestehen',
        'fdh_kraftstoff.required' => 'Bitte gib die Kraftstoffart an',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFzHersteller($hersteller): void
    {
        if (! is_null($hersteller)) {
            $this->models = Models::where('hersteller_id', $hersteller)->orderBy('md_name')->get();
        }
    }

    public function load()
    {
        $this->amount += 15;
    }

    public function mount()
    {
        $this->herstellers = Hersteller::orderBy('hr_name')->get();
        $this->arrays = fahrzeugSpecs();
    }

    public function store()
    {
        $ps = kw_ps($this->fdh_kw)['kw'];
        $validatedData = $this->validate();

        FDH::create([
            'model_id' => $this->model_id,
            'hersteller_id' => $this->fzHersteller,
            'fdh_hsn' => $this->fdh_hsn,
            'fdh_tsn' => $this->fdh_tsn,
            'fdh_type' => $this->fdh_type,
            'fdh_kw' => $this->fdh_kw,
            'fdh_ps' => $ps,
            'fdh_hubraum' => $this->fdh_hubraum,
            'fdh_kraftstoff' => $this->fdh_kraftstoff,
        ]);

        session()->flash('success', 'Fahrzeugdaten wurden dem Model hinzugefügt.');
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->model_id = null;
        $this->fzHersteller = null;
        $this->fdh_hsn = null;
        $this->fdh_tsn = null;
        $this->fdh_type = null;
        $this->fdh_kw = null;
        $this->fdh_ps = null;
        $this->fdh_hubraum = null;
        $this->fdh_kraftstoff = null;
    }

    public function edit($id)
    {
        $fdh = FDH::with('models')->findOrFail($id);
        $this->models = Models::where('hersteller_id', $fdh->hersteller_id)->orderBy('md_name')->get();
        $this->selected_id = $fdh->id;
        $this->model_id = $fdh->model_id;
        $this->fzHersteller = $fdh->hersteller_id;
        $this->fdh_hsn = $fdh->fdh_hsn;
        $this->fdh_tsn = $fdh->fdh_tsn;
        $this->fdh_type = $fdh->fdh_type;
        $this->fdh_kw = $fdh->fdh_kw;
        $this->fdh_ps = $fdh->fdh_ps;
        $this->fdh_hubraum = $fdh->fdh_hubraum;
        $this->fdh_kraftstoff = $fdh->fdh_kraftstoff;
        $this->updateMode = true;
    }

    public function update()
    {
        if ($this->selected_id) {
            $fdh = FDH::findOrFail($this->selected_id);
            $ps = kw_ps($this->fdh_kw)['kw'];
            $fdh->update([
                'model_id' => $this->model_id,
                'hersteller_id' => $this->fzHersteller,
                'fdh_hsn' => $this->fdh_hsn,
                'fdh_tsn' => $this->fdh_tsn,
                'fdh_type' => $this->fdh_type,
                'fdh_kw' => $this->fdh_kw,
                'fdh_ps' => $ps,
                'fdh_hubraum' => $this->fdh_hubraum,
                'fdh_kraftstoff' => $this->fdh_kraftstoff,
            ]);
        }
        $this->resetInput();
        session()->flash('success', 'Fahrzeugdaten wurden geändert.');
        $this->updateMode = false;
    }

    public function destroy($id)
    {
        if ($id) {
            FDH::where('id', $id)->delete();
        }
        session()->flash('error', 'Fahrzeugdaten wurden gelöscht.');
    }

    public function render()
    {
        $pages = [[['text' => 'Vehicle Data', 'link' => '']]];
        $this->fdhs = FDH::take($this->amount)->with('models')->orderBy('fdh_type')->get();

        return view('livewire.admin.settings.fdh', ['pages' => $pages]);
    }
}
