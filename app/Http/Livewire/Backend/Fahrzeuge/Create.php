<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Create.php
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
use App\Models\Backend\Kunden\Datenschutzerklaerung;
use App\Models\Backend\Kunden\Kundens;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

class Create extends Component
{
    public $formStep = 1;

    public $fz_hsn = '';

    public $fz_id;

    public $fz_baujahr;

    public $kunde_neu = 0;

    public $kunden_selected = '';

    public $kunden_id;

    public $kunde = [
        'kd_vorname' => null,
        'kd_name' => null,
        'kd_strasse' => null,
        'kd_plz' => null,
        'kd_ort' => null,
    ];

    public $kd_vorname;

    public $kd_name;

    public $kd_strasse;

    public $kd_plz;

    public $kd_ort;

    public $fahrzeug = [
        'fz_hsn' => '',
        'fz_kilometerstand' => 0,
        'fz_rdks' => 'Kein',
        'fz_getriebeart' => 'Schaltgetriebe',
        'fz_sitzplaetze' => 5,
        'fz_tueren' => 4,
        'fz_schlafplaetze' => 0,
        'fz_achsen' => 2,
        'fz_gaenge' => 5,
        'fz_zylinder' => 5,
    ];

    public $age;

    public $hu = false;

    public $latestKundenID;

    public $latestID;

    protected $messages = [
        'fahrzeug.hersteller_id.required' => 'Bitte wähle einen Fahrzeughersteller aus.',
        'fahrzeug.model_id.required' => 'Bitte wähle dein Fahrzeug Model aus',
        'fahrzeug.fz_type.required' => 'Bitte wähle deinen Fahrzeug Type aus',
        'fahrzeug.fz_hubraum.required' => 'Bitte gib deinen Hubraum an P.1 im Fahrzeugschein',
        'fahrzeug.fz_fz_id_nr.required' => 'Bitte gib eine Fahrzeug-Identifizierungsnummer an E im Fahrzeugschein',
        'fahrzeug.fz_hsn.required' => 'Bitte gib deine HSN an 2.1 im Fahrzeugschein',
        'fahrzeug.fz_hsn.max' => 'Die HSN darf nur 4 Zahlen enthalten',
        'fahrzeug.fz_tsn.required' => 'Bitte gib deine TSN an 2.2 im Fahrzeugschein',
        'fahrzeug.fz_tsn.max' => 'Die TSN darf maximal 9 Zeichen enthalten',
        'fahrzeug.fz_hu.required' => 'Bitte gib den Termin für die nächste Hauptuntersuchung an',
        'fahrzeug.fz_hu.date_format' => 'HU entspricht nicht dem gültigen Format (Monat Jahr).',
        'kunde.kd_name.required' => 'Name muss ausgefüllt werden.',
        'kunde.kd_vorname.required' => 'Vorname muss ausgefüllt werden.',
        'kunde.kd_strasse.required' => 'Strasse muss ausgefüllt werden.',
        'kunde.kd_plz.required' => 'PLZ muss ausgefüllt werden.',
        'kunde.kd_ort.required' => 'Ort muss ausgefüllt werden.',
    ];

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
            'fahrzeug.fz_kennzeichen' => 'nullable',
            'fahrzeug.hersteller_id' => 'required',
            'fahrzeug.model_id' => 'required',
            'fahrzeug.fz_hersteller' => 'nullable',
            'fahrzeug.fz_model' => 'nullable',
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
            'fahrzeug.fz_hu' => 'required',
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
            //            'kunde.kd_vorname' => $vorname,
            'kunde.kd_strasse' => $strasse,
            'kunde.kd_plz' => $plz,
            'kunde.kd_ort' => $ort,
        ];
    }

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

    public function updatedFahrzeugFzTsn($field)
    {
        if ($this->fahrzeug['fz_hsn']) {
            $tsnID = FahrzeugDatenHersteller::where('fdh_tsn', $field)->where('fdh_hsn', $this->fahrzeug['fz_hsn'])->first();
            if (! is_null($tsnID)) {
                $this->fahrzeug['model_id'] = $tsnID->model_id;
                $this->fahrzeug['fz_hubraum'] = $tsnID->fdh_hubraum;
                $this->fahrzeug['fz_kw'] = $tsnID->fdh_kw;
                $this->fahrzeug['fz_ps'] = $tsnID->fdh_ps;
                $this->fahrzeug['fz_treibstoff'] = $tsnID->fdh_kraftstoff;
                $this->fahrzeug['fz_type'] = $tsnID->fdh_type;
            }
        }
    }

    public function updatedFahrzeugFzHsn($field)
    {
        $hsnID = HSN::where('hsn', $field)->first();
        if (! is_null($hsnID)) {
            $this->fahrzeug['hersteller_id'] = $hsnID->hersteller_id;
            $this->models = Models::where('hersteller_id', $this->fahrzeug['hersteller_id'])->get();
        }
        $this->fz_hsn = $field;
        $this->fahrzeug['fz_tsn'] = null;
    }

    public function updatedFahrzeugHerstellerId($field): void
    {
        if (! is_null($field)) {
            $this->models = Models::where('hersteller_id', $this->fahrzeug['hersteller_id'])->get();
        }
    }

    public function updatedFahrzeugFzEmissionsklasse($field): void
    {
        if (! is_null($field)) {
            $kats = Emissionsklasse::where('id', $field)->first();
            $this->fahrzeug['fz_kat'] = $kats->kat_id;
        }
    }

    public function updatedFahrzeugFzReifen1()
    {
        $this->fahrzeug['fz_reifen_2'] = $this->fahrzeug['fz_reifen_1'];
    }

    public function updatedFahrzeugFzBaujahr($field)
    {
        $this->fz_baujahr = $field;
        $age = Carbon::parse($field)->age;
        if ($age != '0') {
            if ($age == '1') {
                $this->age = $age.' Jahr';
            } else {
                $this->age = $age.' Jahre';
            }
        } else {
            $this->age = $age;
        }
    }

    public function updatedFahrzeugFzGesamtgewicht()
    {
        $this->fahrzeug['fz_nutzgewicht'] = $this->fahrzeug['fz_gesamtgewicht'] - $this->fahrzeug['fz_leergewicht'];
    }

    public function updatedKundenSelected($field)
    {
        $kunden = Kundens::where('id', $field)->first();
        if (! is_null($kunden)) {
            $this->kunde['kunden_id'] = $kunden->id;
            $this->kunde['kd_vorname'] = $kunden->kd_vorname;
            $this->kunde['kd_name'] = $kunden->kd_name;
            $this->kunde['kd_strasse'] = $kunden->kd_strasse;
            $this->kunde['kd_plz'] = $kunden->kd_plz;
            $this->kunde['kd_ort'] = $kunden->kd_ort;
        }
    }

    public function updatedKundeNeu()
    {
        if ($this->kunde_neu) {
            $this->kunde_neu = 1;
        } else {
            $this->kunde_neu = 0;
            $this->kunden_selected = null;
            $this->kunde['kunden_id'] = null;
            $this->kunde['kd_vorname'] = null;
            $this->kunde['kd_name'] = null;
            $this->kunde['kd_strasse'] = null;
            $this->kunde['kd_plz'] = null;
            $this->kunde['kd_ort'] = null;
        }
    }

    public function updatedFahrzeugFzKw($field)
    {
        $this->fahrzeug['fz_ps'] = kw_ps($field)['kw'];
    }

    public function mount()
    {
        $this->latestKundenID = Kundens::latest()->withTrashed()->first()->id + 1;
        $this->latestID = Fahrzeuges::latest()->withTrashed()->first()->id + 1;
        $this->fz_id = $this->latestID;
    }

    public function store()
    {
        $this->fahrzeug['fz_hersteller'] = Hersteller::where('id', $this->fahrzeug['hersteller_id'])->first()->hr_name;
        $this->fahrzeug['fz_model'] = Models::where('id', $this->fahrzeug['model_id'])->first()->md_name;
        $this->fahrzeug['slug'] = SlugService::createSlug(Fahrzeuges::class, 'slug', $this->fahrzeug['fz_hersteller'].' '.$this->fahrzeug['fz_model'].' '.$this->fahrzeug['fz_type']);
        $this->fahrzeug['fz_hu'] = Carbon::parse($this->fahrzeug['fz_hu'])->format('Y-m-d');
        $this->fahrzeug['fz_baujahr'] = Carbon::parse($this->fahrzeug['fz_baujahr'])->format('Y-m-d');
        $validatedData = $this->validate();
        if ($this->kunde_neu === 0) {
            $this->kunde['kd_rabatt_artikel'] = 0;
            $this->kunde['kd_rabatt_arbeit'] = 0;
            $this->kunde['kd_zahlung'] = 'Barzahlung';
            $this->kunde['kd_preisgruppe'] = 'Normalpreise';
            $this->kunde['kd_land'] = 'DE';
            $this->kunde['slug'] = SlugService::createSlug(Kundens::class, 'slug', $this->kunde['kd_vorname'].' '.$this->kunde['kd_name']);
            $this->kunde['kd_kunde_seit'] = Carbon::parse(now())->format('Y-m-d');
            $this->kunde['kd_kundennummer'] = numberRanges($this->latestKundenID, '1');
            $this->kunde['kd_debitor_nr'] = numberRanges($this->latestKundenID, '1');
            $kunde = Kundens::create($this->kunde);
            $this->fahrzeug['kunden_id'] = $kunde->id;
            $fahrzeug = Fahrzeuges::create($this->fahrzeug);
            Datenschutzerklaerung::create(['kunden_id' => $kunde->id]);
        } else {
            $this->fahrzeug['kunden_id'] = $this->kunden_id;
            dd($this);
        }

        session()->flash('success', 'Dem Kunden: '.$kunde->fullname().' wurde folgendes Fahrzeug '.$fahrzeug->fullname().' hinzugefügt.');
        $this->resetInput();

        return redirect()->route('backend.fahrzeuge');
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

    public function render()
    {
        return view('livewire.backend.fahrzeuge.create',
            [
                'herstellers' => Hersteller::orderBy('hr_name', 'ASC')->get(),
                'models' => Models::all(),
                'emissions' => Emissionsklasse::all(),
                'kundens' => Kundens::all(),
            ]);
    }
}
