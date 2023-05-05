<?php

namespace App\Models\Backend\Fahrzeuge;

use App\Models\Admin\Hersteller;
use App\Models\Admin\Models;
use App\Models\Backend\Kunden\Kundens;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fahrzeuges extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['artikel_ld', 'lager_id', 'kunden_id', 'hersteller_id', 'model_id', 'fz_kennzeichen', 'fz_hersteller', 'fz_model', 'fz_type', 'fz_baujahr', 'fz_fz_id_nr', 'fz_hubraum', 'fz_kilometerstand', 'fz_kw', 'fz_ps', 'fz_treibstoff', 'fz_motorcode', 'fz_getriebeart', 'fz_rdks', 'fz_aufbau', 'fz_sitzplaetze', 'fz_tueren', 'fz_schlafplaetze', 'fz_achsen', 'fz_gaenge', 'fz_zylinder', 'fz_leergewicht', 'fz_nutzgewicht', 'fz_gesamtgewicht', 'fz_laenge', 'fz_breite', 'fz_hoehe', 'fz_hsn', 'fz_tsn', 'fz_hu', 'fz_treibstoff', 'fz_plakette', 'fz_kat', 'fz_emissionsklasse', 'fz_farbe', 'fz_farbe_hersteller', 'fz_hersteller_farbe', 'fz_farbcode', 'fz_polsterart', 'fz_polsterfarbe', 'fz_radiocode', 'fz_schluesselnummer', 'fz_infos', 'slug', 'fz_reifen_1', 'fz_reifen_2'];

    protected $casts = ['fz_baujahr' => 'date:Y-m-d', 'fz_hu' => 'date:Y-m-d'];

    public static function pages()
    {
        return [
            [
                [
                    'text' => 'Vehicles',
                    'link' => '',
                ],
            ],
        ];
    }

    public function models(): BelongsTo
    {
        return $this->belongsTo(Models::class)->orderBy('md_name');
    }

    public function hersteller(): BelongsTo
    {
        return $this->belongsTo(Hersteller::class)->orderBy('hr_name');
    }

    public function kunden(): BelongsTo
    {
        return $this->belongsTo(Kundens::class)->orderBy('kd_kundennummer');
    }

    public function getFullnameAttribute(): string
    {
        return $this->fz_hersteller.' '.$this->fz_model.' '.$this->fz_type;
    }

    public function fullname(): string
    {
        return $this->fz_hersteller.' '.$this->fz_model.' '.$this->fz_type;
    }

    public function ez()
    {
        return Carbon::parse($this->fz_baujahr)->format('d.m.Y');
    }

    public function hu()
    {
        return Carbon::parse($this->fz_hu)->format('m.y');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'fullname',
            ],
        ];
    }
}
