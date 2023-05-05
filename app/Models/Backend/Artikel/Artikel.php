<?php

namespace App\Models\Backend\Artikel;

use App\Http\Livewire\Admin\Settings\HerstellerArtikel;
use App\Models\Admin\FahrzeugDatenHersteller;
use App\Models\Admin\Warengruppe;
use App\Models\Backend\Lager\Lager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use SoftDeletes;

    protected $fillable = ['art_lieferant_id', 'art_nr', 'art_name', 'art_ean', 'art_einheit', 'art_mwst', 'art_hersteller', 'art_notiz', 'art_beschreibung'];

    public function fahrzeugDatenHerstellers(): BelongsToMany
    {
        return $this->belongsToMany(FahrzeugDatenHersteller::class, 'artikels_fahrzeug_daten_herstellers');
    }

    public function warengruppes(): BelongsToMany
    {
        return $this->belongsToMany(Warengruppe::class, 'artikels_warengruppes');
    }

    public function lagers(): HasOne
    {
        return $this->hasOne(Lager::class, 'artikel_id');
    }

    public function herstellerArtikel($id)
    {
        return HerstellerArtikel::where('id', $id)->first()->ha_name;
    }

    public function preises(): HasOne
    {
        return $this->hasOne(Preise::class);
    }
}
