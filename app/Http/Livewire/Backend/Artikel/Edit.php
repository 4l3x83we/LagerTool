<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Edit.php
 * User: ${USER}
 * Date: 28.${MONTH_NAME_FULL}.2023
 * Time: 12:46
 */

namespace App\Http\Livewire\Backend\Artikel;

use App\Models\Admin\Einheits;
use App\Models\Admin\hersteller_artikel;
use App\Models\Admin\MwSt;
use App\Models\Admin\Warengruppe;
use App\Models\Backend\Artikel\Artikel;
use App\Models\Backend\Upload;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $artikel;

    public $hersteller;

    public $preises;

    public $lager;

    public $warengruppe;

    public $images = [];

    public $formStep = 1;

    protected $messages = [
        'artikel.art_nr' => 'Bitte gib eine Artikelnummer ein',
        'artikel.art_name' => 'Bitte gib eine Artikelbezeichnung ein',
        'artikel.art_hersteller' => 'Bitte wähle einen Hersteller aus',
    ];

    public function nextStep()
    {
        $this->validate();
        $this->formStep++;
    }

    public function prevStep()
    {
        $this->formStep--;
    }

    public function rules()
    {
        return [
            'artikel.id' => 'nullable',
            'artikel.art_lieferant_id' => 'nullable',
            'artikel.art_nr' => 'required',
            'artikel.art_name' => 'required',
            'artikel.art_ean' => 'nullable',
            'artikel.art_einheit' => 'nullable',
            'artikel.art_mwst' => 'nullable',
            'artikel.art_hersteller' => 'required',
            'artikel.art_notiz' => 'nullable',
            'artikel.art_beschreibung' => 'nullable',
            'preises.pr_ek_anzeigen' => 'nullable',
            'preises.pr_netto_ek' => 'nullable',
            'preises.pr_brutto_ek' => 'nullable',
            'preises.pr_netto_vk' => 'nullable',
            'preises.pr_brutto_vk' => 'nullable',
            'preises.pr_mwst' => 'nullable',
            'preises.pr_prg_1_netto_vk' => 'nullable',
            'preises.pr_prg_2_netto_vk' => 'nullable',
            'preises.pr_prg_3_netto_vk' => 'nullable',
            'preises.pr_prg_4_netto_vk' => 'nullable',
            'preises.pr_prg_5_netto_vk' => 'nullable',
            'preises.pr_prg_1_brutto_vk' => 'nullable',
            'preises.pr_prg_2_brutto_vk' => 'nullable',
            'preises.pr_prg_3_brutto_vk' => 'nullable',
            'preises.pr_prg_4_brutto_vk' => 'nullable',
            'preises.pr_prg_5_brutto_vk' => 'nullable',
            'lager.la_bestand' => 'nullable',
            'lager.la_lagerfuehrung' => 'nullable',
            'lager.la_min' => 'nullable',
            'lager.la_max' => 'nullable',
            'lager.la_lagerort' => 'nullable',
            'warengruppe.id' => 'nullable',
            'images' => 'nullable|max:10240',
        ];
    }

    public function mount($id)
    {
        $this->artikel = Artikel::with(['warengruppes', 'fahrzeugDatenHerstellers', 'lagers', 'preises', 'uploads'])->findOrFail($id);
        $this->warengruppe['id'] = $this->warengruppe();
        $this->preises = $this->artikel->preises;
        $this->lager = $this->artikel->lagers;
    }

    public function warengruppe()
    {
        $wg = null;
        foreach ($this->artikel->warengruppes as $warengruppe) {
            $wg = $warengruppe->id;
        }

        return $wg;
    }

    public function update()
    {
        if ($this->artikel->warengruppes) {
            $warengruppe = Warengruppe::find($this->warengruppe['id']);
            $warengruppeIds = [$warengruppe->id];
            $this->artikel->warengruppes()->sync($warengruppeIds);
        }
        $artikel = $this->artikel->update($this->validate()['artikel']);
        $this->preises->update($this->validate()['preises']);
        $this->lager->update($this->validate()['lager']);
        $path = replaceStrToLower('images/'.$this->artikel->art_name.'/'.$this->artikel->id);
        if (imageUpload($this->images, $path)) {
            foreach ($this->images as $item => $image) {
                Upload::create([
                    'artikel_id' => $this->artikel->id,
                    'fahrzeug_id' => null,
                    'kunden_id' => null,
                    'size' => imageUpload($this->images, $path)['size'][$item],
                    'file' => imageUpload($this->images, $path)['data'][$item],
                    'folder' => $path,
                    'path' => $path.'/'.imageUpload($this->images, $path)['data'][$item],
                ]);
            }
        }

        session()->flash('success', 'Der Artikel '.$this->artikel['art_name'].' wurde erfolgreich geändert.');

        return redirect(route('backend.artikel'));
    }

    public function render()
    {
        return view('livewire.backend.artikel.edit', [
            'herstellers' => hersteller_artikel::all(),
            'einheits' => Einheits::get(),
            'warengruppes' => Warengruppe::all(),
            'mwsts' => MwSt::all(),
        ]);
    }
}
