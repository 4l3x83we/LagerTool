<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Create.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 09:20
 */

namespace App\Http\Livewire\Backend\Kunden;

use App\Models\Backend\Kunden\Datenschutzerklaerung;
use App\Models\Backend\Kunden\Kundens;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $kunden = [
        'kd_anrede' => 'Herr',
        'kd_kundentype' => 1,
        'kd_rabatt_artikel' => 0,
        'kd_rabatt_arbeit' => 0,
        'kd_zahlung' => 'Barzahlung',
        'kd_preisgruppe' => 'Normalpreis',
        'kd_land' => 'DE',
    ];

    public $datenschutz;

    public $selectAll;

    protected $messages = [
        'kunden.kd_anrede.required' => 'Anrede muss ausgefüllt werden.',
        'kunden.kd_name.required' => 'Name muss ausgefüllt werden.',
        'kunden.kd_vorname.required' => 'Vorname muss ausgefüllt werden.',
        'kunden.kd_strasse.required' => 'Strasse muss ausgefüllt werden.',
        'kunden.kd_land.required' => 'Land muss ausgefüllt werden.',
        'kunden.kd_plz.required' => 'PLZ muss ausgefüllt werden.',
        'kunden.kd_plz.min' => 'PLZ muss mindestens 5 Zeichen lang sein.',
        'kunden.kd_plz.max' => 'PLZ darf maximal 5 Zeichen haben.',
        'kunden.kd_plz.numeric' => 'PLZ muss eine Zahl sein.',
        'kunden.kd_ort.required' => 'Ort muss ausgefüllt werden.',
        'datenschutz.da_erteilt_am.required' => 'Erteilt am muss ausgefüllt werden.',
        'kunden.kd_telefon.numeric' => 'Telefon muss eine Zahl sein.',
        'kunden.kd_telefon_gesch.numeric' => 'Telefon geschäftlich muss eine Zahl sein.',
        'kunden.kd_fax.numeric' => 'Fax muss eine Zahl sein.',
        'kunden.kd_mobil.numeric' => 'Mobile muss eine Zahl sein.',
        'kunden.kd_rabatt_artikel.numeric' => 'Rabatt Artikel muss eine Zahl sein.',
        'kunden.kd_rabatt_arbeit.numeric' => 'Rabatt Arbeit muss eine Zahl sein.',
    ];

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
            'datenschutz.kunden_id' => 'nullable',
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

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->datenschutz = [
                'da_briefe' => true,
                'da_telefon' => true,
                'da_fax' => true,
                'da_mobile' => true,
                'da_sms' => true,
                'da_whatsapp' => true,
                'da_email' => true,
            ];
        } else {
            $this->datenschutz = [];
        }
    }

    public function store()
    {
        $this->validate();
        if (! empty($this->kunden['kd_anmerkungen'])) {
            $this->kunden['kd_anmerkungen'] = nl2br(htmlentities($this->validate()['kunden']['kd_anmerkungen'], ENT_QUOTES, 'UTF-8'));
        }
        $kunde = Kundens::create($this->kunden);
        $this->datenschutz['kunden_id'] = $kunde->id;
        Datenschutzerklaerung::create($this->datenschutz);

        session()->flash('success', $kunde->fullname().' wurde angelegt!');

        return redirect()->route('backend.kunden');
    }

    public function render()
    {
        $this->kunden['kd_kundennummer'] = numberRanges($this->lastID() + 1, '1');
        $this->kunden['kd_debitor_nr'] = $this->kunden['kd_kundennummer'];
        $this->kunden['kd_kunde_seit'] = Carbon::parse(now())->format('Y-m-d');
        $this->datenschutz['da_erteilt_am'] = Carbon::parse(now())->format('Y-m-d');

        return view('livewire.backend.kunden.create');
    }

    public function lastID()
    {
        return Kundens::latest()->withTrashed()->first()->id;
    }
}
