<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Edit.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 09:23
 */

namespace App\Http\Livewire\Backend\Fahrzeuge;

use App\Models\Admin\Emissionsklasse;
use App\Models\Admin\FahrzeugDatenHersteller;
use App\Models\Admin\Hersteller;
use App\Models\Admin\HSN;
use App\Models\Admin\Models;
use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use App\Models\Backend\Kunden\Kundens;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $fz_hsn;

    public $fz_baujahr;

    public $formStep = 1;

    public $fahrzeug;

    public $kunde;

    public $fz_hu;

    public $kunde_neu = 0;

    public $kunden_selected = '';

    public function nextStep(): void
    {
        $this->validate();
        $this->formStep++;
    }

    public function prevStep(): void
    {
        $this->formStep--;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFahrzeugFzHsn($field)
    {
        $hsnID = HSN::where('hsn', $field)->first();
        if (! is_null($hsnID)) {
            $this->fahrzeug['fz_hersteller'] = Hersteller::where('id', '=', $hsnID->hersteller_id)->first()->hr_name;
            $this->fahrzeug['hersteller_id'] = $hsnID->hersteller_id;
        }
    }

    public function add2Years(): void
    {
        $this->fz_hu = Carbon::parse($this->fz_hu)->addYears(2)->format('Y-m');
    }

    public function add1Year(): void
    {
        $this->fz_hu = Carbon::parse($this->fz_hu)->addYears(1)->format('Y-m');
    }

    public function updatedFahrzeugFzTsn($field)
    {
        $tsnID = FahrzeugDatenHersteller::where('fdh_tsn', $field)->where('fdh_hsn', $this->fahrzeug->fz_hsn)->first();
        if (! is_null($tsnID)) {
            $this->fahrzeug->fz_model = Models::where('id', '=', $tsnID->model_id)->first()->md_name;
            $this->fahrzeug->model_id = $tsnID->model_id;
            $this->fahrzeug->fz_hubraum = $tsnID->fdh_hubraum;
            $this->fahrzeug->fz_kw = $tsnID->fdh_kw;
            $this->fahrzeug->fz_ps = $tsnID->fdh_ps;
            $this->fahrzeug->fz_treibstoff = $tsnID->fdh_kraftstoff;
            $this->fahrzeug->fz_type = $tsnID->fdh_type;
        }
    }

    public function mount($id)
    {
        $this->fahrzeug = Fahrzeuges::where('slug', '=', $id)->first();
        $this->fz_hu = Carbon::parse($this->fahrzeug['fz_hu'])->isoFormat('YYYY-MM');
        $this->kunde = Kundens::where('id', '=', $this->fahrzeug->kunden_id)->first();
    }

    public function update()
    {
        $validateData = $this->validate();

        $validateData['fahrzeug']['fz_hu'] = $this->fahrzeug['fz_hu'];
        $validateData['fahrzeug']['updated_at'] = now();
        $validateData['kunde']['updated_at'] = now();
        $validateData['fahrzeug']['fz_hersteller'] = Hersteller::where('id', $this->fahrzeug['hersteller_id'])->first()->hr_name;
        $validateData['fahrzeug']['fz_model'] = Models::where('id', $this->fahrzeug['model_id'])->first()->md_name;
        $validateData['fahrzeug']['hersteller_id'] = $this->fahrzeug['hersteller_id'];
        $fullName = $this->kunde->fullname();
        $this->kunde->update($validateData['kunde']);
        $this->fahrzeug->update($validateData['fahrzeug']);

        session()->flash('success', 'Dem Kunden: '.$fullName.' sein Fahrzeug '.$this->fahrzeug->fullname().' wurde geändert.');
        $this->resetInput();

        return redirect(route('backend.fahrzeuge'));
    }

    public function resetInput()
    {
        $this->artikel_ld = null;
        $this->lager_id = null;
        $this->kunden_id = null;
        $this->fz_kennzeichen = null;
        $this->fz_hersteller = null;
        $this->fz_model = null;
        $this->fz_type = null;
        $this->fz_baujahr = null;
        $this->fz_fz_id_nr = null;
        $this->fz_hubraum = null;
        $this->fz_kilometerstand = null;
        $this->fz_kw = null;
        $this->fz_ps = null;
        $this->fz_motorcode = null;
        $this->fz_getriebeart = null;
        $this->fz_reifen_1 = null;
        $this->fz_reifen_2 = null;
        $this->fz_aufbau = null;
        $this->fz_sitzplaetze = null;
        $this->fz_tueren = null;
        $this->fz_schlafplaetze = null;
        $this->fz_achsen = null;
        $this->fz_gaenge = null;
        $this->fz_zylinder = null;
        $this->fz_leergewicht = null;
        $this->fz_nutzgewicht = null;
        $this->fz_gesamtgewicht = null;
        $this->fz_rdks = null;
        $this->fz_laenge = null;
        $this->fz_breite = null;
        $this->fz_hoehe = null;
        $this->fz_hsn = null;
        $this->fz_tsn = null;
        $this->fz_hu = null;
        $this->fz_treibstoff = null;
        $this->fz_plakette = null;
        $this->fz_kat = null;
        $this->fz_emissionsklasse = null;
        $this->fz_farbe = null;
        $this->fz_farbe_hersteller = null;
        $this->fz_hersteller_farbe = null;
        $this->fz_farbcode = null;
        $this->fz_polsterart = null;
        $this->fz_polsterfarbe = null;
        $this->fz_radiocode = null;
        $this->fz_schluesselnummer = null;
        $this->fz_infos = null;
        $this->kunde_neu = 0;
        $this->kunden_vorname = null;
        $this->kunden_name = null;
        $this->kunden_strasse = null;
        $this->kunden_plz = null;
        $this->kunden_ort = null;
        $this->resetValidation();
    }

    public function rules()
    {
        $vorname = $this->kunde_neu === 0 ? 'required' : 'nullable';
        $name = $this->kunde_neu === 0 ? 'required' : 'nullable';
        $strasse = $this->kunde_neu === 0 ? 'required' : 'nullable';
        $plz = $this->kunde_neu === 0 ? 'required' : 'nullable';
        $ort = $this->kunde_neu === 0 ? 'required' : 'nullable';

        return [
            'fahrzeug.id' => 'nullable',
            'fahrzeug.artikel_ld' => 'nullable',
            'fahrzeug.lager_id' => 'nullable',
            'fahrzeug.kunden_id' => 'nullable',
            'fahrzeug.hersteller_id' => 'nullable',
            'fahrzeug.model_id' => 'nullable',
            'fahrzeug.fz_kennzeichen' => 'nullable',
            'fahrzeug.fz_hersteller' => 'required',
            'fahrzeug.fz_model' => 'required',
            'fahrzeug.fz_type' => 'nullable',
            'fahrzeug.fz_baujahr' => 'nullable',
            'fahrzeug.fz_fz_id_nr' => 'required',
            'fahrzeug.fz_hubraum' => 'nullable',
            'fahrzeug.fz_kilometerstand' => 'nullable',
            'fahrzeug.fz_kw' => 'nullable',
            'fahrzeug.fz_ps' => 'nullable',
            'fahrzeug.fz_treibstoff' => 'nullable',
            'fahrzeug.fz_motorcode' => 'nullable',
            'fahrzeug.fz_getriebeart' => 'nullable',
            'fahrzeug.fz_rdks' => 'nullable',
            'fahrzeug.fz_aufbau' => 'nullable',
            'fahrzeug.fz_sitzplaetze' => 'nullable',
            'fahrzeug.fz_tueren' => 'nullable',
            'fahrzeug.fz_schlafplaetze' => 'nullable',
            'fahrzeug.fz_achsen' => 'nullable',
            'fahrzeug.fz_gaenge' => 'nullable',
            'fahrzeug.fz_zylinder' => 'nullable',
            'fahrzeug.fz_leergewicht' => 'nullable',
            'fahrzeug.fz_nutzgewicht' => 'nullable',
            'fahrzeug.fz_gesamtgewicht' => 'nullable',
            'fahrzeug.fz_laenge' => 'nullable',
            'fahrzeug.fz_breite' => 'nullable',
            'fahrzeug.fz_hoehe' => 'nullable',
            'fahrzeug.fz_hsn' => 'required|max:4',
            'fahrzeug.fz_tsn' => 'required|max:9',
            'fahrzeug.fz_hu' => 'nullable',
            'fahrzeug.fz_plakette' => 'nullable',
            'fahrzeug.fz_kat' => 'nullable',
            'fahrzeug.fz_emissionsklasse' => 'nullable',
            'fahrzeug.fz_farbe' => 'nullable',
            'fahrzeug.fz_farbe_hersteller' => 'nullable',
            'fahrzeug.fz_hersteller_farbe' => 'nullable',
            'fahrzeug.fz_farbcode' => 'nullable',
            'fahrzeug.fz_polsterart' => 'nullable',
            'fahrzeug.fz_polsterfarbe' => 'nullable',
            'fahrzeug.fz_radiocode' => 'nullable',
            'fahrzeug.fz_schluesselnummer' => 'nullable',
            'fahrzeug.fz_infos' => 'nullable',
            'fahrzeug.fz_reifen_1' => 'nullable',
            'fahrzeug.fz_reifen_2' => 'nullable',
            'kunde.kd_name' => $name,
            'kunde.kd_vorname' => $vorname,
            'kunde.kd_strasse' => $strasse,
            'kunde.kd_plz' => $plz,
            'kunde.kd_ort' => $ort,
        ];
    }

    public function render()
    {
        return view('livewire.backend.fahrzeuge.edit', [
            'herstellers' => Hersteller::get(),
            'models' => Models::get(),
            'emissions' => Emissionsklasse::get(),
        ]
        );
    }
}
