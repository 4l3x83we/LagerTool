<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Edit.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 09:21
 */

namespace App\Http\Livewire\Backend\Kunden;

use App\Models\Backend\Kunden\Datenschutzerklaerung;
use App\Models\Backend\Kunden\Kundens;
use Livewire\Component;

class Edit extends Component
{
    public $kunden;

    public $datenschutz;

    public function rules()
    {
        $vorname = $this->kunden['kd_kundentype'] === 1 ? 'required' : 'nullable';

        return [
            'kunden.kd_kundennummer' => 'nullable',
            'kunden.kd_kundentype' => 'nullable',
            'kunden.kd_anrede' => 'required',
            'kunden.kd_name' => 'required',
            'kunden.kd_vorname' => $vorname,
            'kunden.kd_zusatz' => 'nullable',
            'kunden.kd_strasse' => 'required',
            'kunden.kd_land' => 'required',
            'kunden.kd_plz' => 'required|min:5|numeric',
            'kunden.kd_ort' => 'required',
            'kunden.kd_telefon' => 'nullable',
            'kunden.kd_telefon_gesch' => 'nullable',
            'kunden.kd_fax' => 'nullable',
            'kunden.kd_mobil' => 'nullable',
            'kunden.kd_email' => 'nullable|email',
            'kunden.kd_webseite' => 'nullable',
            'kunden.kd_ust_id_nr' => 'nullable',
            'kunden.kd_ausl_kunde' => 'nullable',
            'kunden.kd_anmerkungen_anzeigen' => 'nullable',
            'kunden.kd_anmerkungen' => 'nullable',
            'kunden.kd_rabatt_artikel' => 'nullable|numeric',
            'kunden.kd_rabatt_arbeit' => 'nullable|numeric',
            'kunden.kd_zahlung' => 'nullable',
            'kunden.kd_preisgruppe' => 'nullable',
            'kunden.kd_debitor_nr' => 'nullable',
            'kunden.kd_geburtsdatum' => 'nullable|date',
            'kunden.kd_kunde_seit' => 'nullable|date',
            'datenschutz.da_erteilt_am' => 'required|date',
            'datenschutz.da_briefe' => 'nullable',
            'datenschutz.da_email' => 'nullable',
            'datenschutz.da_telefon' => 'nullable',
            'datenschutz.da_fax' => 'nullable',
            'datenschutz.da_mobile' => 'nullable',
            'datenschutz.da_sms' => 'nullable',
            'datenschutz.da_whatsapp' => 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedDatenschutz()
    {
        $this->datenschutz->update([$this->datenschutz]);
        session()->flash('info', 'Datenschutzerklärung wurde geändert.');
    }

    public function update()
    {
        $this->kunden->update($this->validate()['kunden']);
        session()->flash('success', 'Die Daten von '.$this->kunden['kd_vorname'].' '.$this->kunden['kd_name'].' wurden geändert!');

        return redirect()->route('backend.kunden');
    }

    public function mount($id)
    {
        $this->kunden = Kundens::where('slug', '=', $id)->first();
    }

    public function render()
    {
        $this->datenschutz = Datenschutzerklaerung::where('kunden_id', '=', $this->kunden->id)->first();

        return view('livewire.backend.kunden.edit');
    }
}
