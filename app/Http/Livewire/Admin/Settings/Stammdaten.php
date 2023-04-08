<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Stammdaten.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:48
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\Stammdatens;
use Livewire\Component;
use Livewire\WithFileUploads;

class Stammdaten extends Component
{
    use WithFileUploads;

    public $stammdatens;

    public $stammdaten;

    public $sd_firmenname;

    public $sd_strasse;

    public $sd_plz;

    public $sd_ort;

    public $sd_telefon;

    public $sd_fax;

    public $sd_mobil;

    public $sd_steuernummer;

    public $sd_firmenzusatz;

    public $sd_absender;

    public $sd_laenderkuerzel = 'DE';

    public $sd_webseite;

    public $sd_email;

    public $sd_ust_id;

    public $sd_kontoinhaber;

    public $sd_iban;

    public $sd_bic;

    public $sd_bankname;

    public $image;

    public $selected_id;

    public $countryCodes;

    public $updateMode = false;

    protected $rules = [
        'sd_firmenname' => 'required',
        'sd_strasse' => 'required',
        'sd_plz' => 'required|numeric',
        'sd_ort' => 'required',
        'sd_telefon' => 'nullable',
        'sd_fax' => 'nullable',
        'sd_mobil' => 'nullable',
        'sd_steuernummer' => 'nullable',
        'sd_firmenzusatz' => 'nullable',
        'sd_absender' => 'required',
        'sd_laenderkuerzel' => 'required',
        'sd_webseite' => 'nullable',
        'sd_email' => 'nullable',
        'sd_ust_id' => 'nullable',
        'sd_kontoinhaber' => 'nullable',
        'sd_iban' => 'nullable',
        'sd_bic' => 'nullable',
        'sd_bankname' => 'nullable',
        //        'image' => 'image|max:10240',
    ];

    protected $messages = [
        'sd_firmenname.required' => 'Bitte gib deinen Firmennamen an.',
        'sd_strasse.required' => 'Bitte gib deine Straße der Firma an.',
        'sd_plz.required' => 'Bitte gib deine Postleitzahl der Firma an.',
        'sd_plz.numeric' => 'Die Postleitzahl darf aus maximal 5 Zahlen bestehen.',
        'sd_ort.required' => 'Bitte gib deinen Ort der Firma an.',
        'sd_absender.required' => 'Bitte gib deinen Namen an.',
        'sd_laenderkuerzel.required' => 'Bitte gib dein Land an.',
        //        'image.required' => 'Datei muss ein Bild ein.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();
        Stammdatens::create($validatedData);
        $this->reset();
        session()->flash('success', 'Firmendaten wurden erfolgreich angelegt.');

        return redirect()->back();
    }

    public function edit($id)
    {
        $this->stammdaten = Stammdatens::findOrFail($id);
        $this->selected_id = $this->stammdaten->id;
        $this->sd_firmenname = $this->stammdaten->sd_firmenname;
        $this->sd_firmenzusatz = $this->stammdaten->sd_firmenzusatz;
        $this->sd_absender = $this->stammdaten->sd_absender;
        $this->sd_strasse = $this->stammdaten->sd_strasse;
        $this->sd_plz = $this->stammdaten->sd_plz;
        $this->sd_ort = $this->stammdaten->sd_ort;
        $this->sd_laenderkuerzel = $this->stammdaten->sd_laenderkuerzel;
        $this->sd_telefon = $this->stammdaten->sd_telefon;
        $this->sd_fax = $this->stammdaten->sd_fax;
        $this->sd_mobil = $this->stammdaten->sd_mobil;
        $this->sd_email = $this->stammdaten->sd_email;
        $this->sd_webseite = $this->stammdaten->sd_webseite;
        $this->sd_steuernummer = $this->stammdaten->sd_steuernummer;
        $this->sd_ust_id = $this->stammdaten->sd_ust_id;
        $this->sd_kontoinhaber = $this->stammdaten->sd_kontoinhaber;
        $this->sd_bankname = $this->stammdaten->sd_bankname;
        $this->sd_bic = $this->stammdaten->sd_bic;
        $this->sd_iban = $this->stammdaten->sd_iban;
        $this->updateMode = true;
    }

    public function update()
    {
        if ($this->selected_id) {
            $stammdaten = Stammdatens::find($this->selected_id);
            $stammdaten->update([
                'sd_firmenname' => $this->sd_firmenname,
                'sd_firmenzusatz' => $this->sd_firmenzusatz,
                'sd_absender' => $this->sd_absender,
                'sd_strasse' => $this->sd_strasse,
                'sd_plz' => $this->sd_plz,
                'sd_ort' => $this->sd_ort,
                'sd_laenderkuerzel' => $this->sd_laenderkuerzel,
                'sd_telefon' => $this->sd_telefon,
                'sd_fax' => $this->sd_fax,
                'sd_mobil' => $this->sd_mobil,
                'sd_email' => $this->sd_email,
                'sd_webseite' => $this->sd_webseite,
                'sd_steuernummer' => $this->sd_steuernummer,
                'sd_ust_id' => $this->sd_ust_id,
                'sd_kontoinhaber' => $this->sd_kontoinhaber,
                'sd_bankname' => $this->sd_bankname,
                'sd_bic' => $this->sd_bic,
                'sd_iban' => $this->sd_iban,
            ]);
        }

        session()->flash('success', 'Firmendaten wurden erfolgreich geändert.');
        $this->updateMode = false;
    }

    public function destroy($id)
    {
    }

    public function render()
    {
        $this->stammdatens = Stammdatens::get();
        $this->stammdaten = Stammdatens::first();
        $this->countryCodes = countryCode();

        return view('livewire.admin.settings.firma');
    }
}
