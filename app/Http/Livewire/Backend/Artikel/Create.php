<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Create.php
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
use App\Models\Backend\Artikel\Preise;
use App\Models\Backend\Lager\Lager;
use App\Models\Backend\Upload;
use File;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $artikel = [
        'art_mwst' => 19,
    ];

    public $hersteller;

    public $images = [];

    public $preises = [
        'pr_prg_1_netto_vk' => '',
        'pr_prg_2_netto_vk' => '',
        'pr_prg_3_netto_vk' => '',
        'pr_prg_4_netto_vk' => '',
        'pr_prg_5_netto_vk' => '',
        'pr_brutto_ek' => '',
        'pr_mwst' => 19,
    ];

    public $lager;

    public $warengruppe;

    public $formStep = 1;

    protected $messages = [
        'artikel.art_nr' => 'Bitte gib eine Artikelnummer ein',
        'artikel.art_name' => 'Bitte gib eine Artikelbezeichnung ein',
        'artikel.art_hersteller' => 'Bitte wähle einen Hersteller aus',
        'artikel.art_einheit' => 'Einheit muss  ausgewählt werden.',
        'artikel.art_mwst' => 'MwSt muss ausgewählt werden.',
        'warengruppe.id' => 'Warengruppe muss ausgewählt werden.',
    ];

    public function rules()
    {
        return [
            'artikel.id' => 'nullable',
            'artikel.art_lieferant_id' => 'nullable',
            //            'artikel.art_nr' => 'required',
            //            'artikel.art_name' => 'required',
            'artikel.art_ean' => 'nullable',
            //            'artikel.art_einheit' => 'required',
            //            'artikel.art_mwst' => 'required',
            //            'artikel.art_hersteller' => 'required',
            'artikel.art_notiz' => 'nullable',
            'artikel.art_beschreibung' => 'nullable',
            'preises.artikel_id' => 'nullable',
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
            'lager.artikel_id' => 'nullable',
            'lager.la_bestand' => 'nullable',
            'lager.la_lagerfuehrung' => 'nullable',
            'lager.la_min' => 'nullable',
            'lager.la_max' => 'nullable',
            'lager.la_lagerort' => 'nullable',
            //            'warengruppe.id' => 'required',
            'images' => ['nullable', 'image', 'max:10240'],
        ];
    }

    public function nextStep()
    {
        $this->validate();
        $this->formStep++;
    }

    public function prevStep()
    {
        $this->formStep--;
    }

    public function updatedArtikelArtMwst()
    {
        $this->preises['pr_mwst'] = $this->artikel['art_mwst'];
    }

    public function updatedPreisesPrNettoEk()
    {
        $netto = $this->preises['pr_netto_ek'];
        $this->preises['pr_brutto_ek'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
    }

    public function updatedPreisesPrNettoVk()
    {
        $netto = $this->preises['pr_netto_vk'];
        $this->preises['pr_brutto_vk'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
    }

    public function updatedPreisesPrPrg1NettoVk()
    {
        if ($this->preises['pr_prg_1_netto_vk']) {
            $netto = $this->preises['pr_prg_1_netto_vk'];
            $this->preises['pr_prg_1_brutto_vk'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
        } else {
            $this->preises['pr_prg_1_brutto_vk'] = null;
        }
    }

    public function updatedPreisesPrPrg2NettoVk()
    {
        if ($this->preises['pr_prg_2_netto_vk']) {
            $netto = $this->preises['pr_prg_2_netto_vk'];
            $this->preises['pr_prg_2_brutto_vk'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
        } else {
            $this->preises['pr_prg_2_brutto_vk'] = null;
        }
    }

    public function updatedPreisesPrPrg3NettoVk()
    {
        if ($this->preises['pr_prg_3_netto_vk']) {
            $netto = $this->preises['pr_prg_3_netto_vk'];
            $this->preises['pr_prg_3_brutto_vk'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
        } else {
            $this->preises['pr_prg_3_brutto_vk'] = null;
        }
    }

    public function updatedPreisesPrPrg4NettoVk()
    {
        if ($this->preises['pr_prg_4_netto_vk']) {
            $netto = $this->preises['pr_prg_4_netto_vk'];
            $this->preises['pr_prg_4_brutto_vk'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
        } else {
            $this->preises['pr_prg_4_brutto_vk'] = null;
        }
    }

    public function updatedPreisesPrPrg5NettoVk()
    {
        if ($this->preises['pr_prg_5_netto_vk']) {
            $netto = $this->preises['pr_prg_5_netto_vk'];
            $this->preises['pr_prg_5_brutto_vk'] = mwstClean($netto, $this->preises['pr_mwst'])['brutto'];
        } else {
            $this->preises['pr_prg_5_brutto_vk'] = null;
        }
    }

    public function updatedPreisesPrBruttoVk()
    {
        $brutto = $this->preises['pr_brutto_vk'];
        $this->preises['pr_netto_vk'] = mwstClean($brutto, $this->preises['pr_mwst'])['netto'];
    }

    public function store()
    {
        /*$images = collect($this->images)->each(fn ($image) => $image->getRealPath()
        );*/
        $path = '/images/'.replaceBlank('artikel id');
        $images = $this->images;
        if (! empty($images)) {
            foreach ($this->images as $image) {
                $imageName = replaceBlank(time().'-'.$image->getClientOriginalName());
                if (! File::isDirectory(public_path($path))) {
                    File::makeDirectory(public_path($path), 777, true, true);
                }

                if (! File::isDirectory(public_path($path.'/thumbnails'))) {
                    File::makeDirectory(public_path($path.'/thumbnails'), 777, true, true);
                }

                $thumbnails = Image::make($image)->resize(151.2, 151.2, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->stream();
                File::put(public_path($path.'/thumbnails/'.$imageName), $thumbnails);

                $photo = Image::make($image)->stream();
                File::put(public_path($path.'/'.$imageName), $photo);
                Upload::create([
                    'artikel_id' => 2,
                    'size' => bytesToHuman($image->getSize()),
                    'file' => $imageName,
                    'folder' => $path,
                    'path' => $path.'/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            dd($this->images, $imageName, $path, $photo, $thumbnails);
        }

        dd($images);
        $this->validate();
        if (! empty($this->artikel['art_notiz'])) {
            $this->artikel['art_notiz'] = nl2br(htmlentities($this->validate()['artikel']['art_notiz'], ENT_QUOTES, 'UTF-8'));
        }
        if (! empty($this->artikel['art_beschreibung'])) {
            $this->artikel['art_beschreibung'] = nl2br(htmlentities($this->validate()['artikel']['art_beschreibung'], ENT_QUOTES, 'UTF-8'));
        }
        if ($this->preises['pr_prg_1_netto_vk'] == '') {
            $this->preises['pr_prg_1_netto_vk'] = null;
        }
        if ($this->preises['pr_prg_2_netto_vk'] == '') {
            $this->preises['pr_prg_2_netto_vk'] = null;
        }
        if ($this->preises['pr_prg_3_netto_vk'] == '') {
            $this->preises['pr_prg_3_netto_vk'] = null;
        }
        if ($this->preises['pr_prg_4_netto_vk'] == '') {
            $this->preises['pr_prg_4_netto_vk'] = null;
        }
        if ($this->preises['pr_prg_5_netto_vk'] == '') {
            $this->preises['pr_prg_5_netto_vk'] = null;
        }
        $this->preises['pr_mwst'] = $this->artikel['art_mwst'];
        $artikel = Artikel::create($this->validate()['artikel']);
        $this->lager['artikel_id'] = $artikel->id;
        $this->preises['artikel_id'] = $artikel->id;
        Lager::create($this->validate()['lager']);
        Preise::create($this->validate()['preises']);
        $artikel->warengruppes()->attach($this->warengruppe['id']);

        session()->flash('success', 'Artikel wurde erfolgreich angelegt.');

        return redirect(route('backend.artikel'));
    }

    public function render()
    {
        return view('livewire.backend.artikel.create', [
            'herstellers' => hersteller_artikel::all(),
            'einheits' => Einheits::get(),
            'warengruppes' => Warengruppe::all(),
            'mwsts' => MwSt::all(),
        ]);
    }
}
