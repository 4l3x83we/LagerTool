<?php

namespace App\Models\Backend\Kunden;

use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kundens extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['kd_kundennummer', 'kd_kundentype', 'kd_anrede', 'kd_name', 'kd_vorname', 'kd_zusatz', 'kd_strasse', 'kd_land', 'kd_plz', 'kd_ort', 'kd_telefon', 'kd_telefon_gesch', 'kd_fax', 'kd_mobil', 'kd_email', 'kd_webseite', 'kd_ust_id_nr', 'kd_ausl_kunde', 'kd_anmerkungen_anzeigen', 'kd_anmerkungen', 'kd_rabatt_artikel', 'kd_rabatt_arbeit', 'kd_zahlung', 'kd_preisgruppe', 'kd_debitor_nr', 'kd_geburtsdatum', 'kd_kunde_seit', 'slug'];

    protected $casts = [
        'kd_geburtsdatum' => 'date:Y-m-d',
        'kd_kunde_seit' => 'date:Y-m-d',
    ];

    public static function pages()
    {
        return [
            [
                [
                    'text' => 'Customers',
                    'link' => '',
                ],
            ],
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'fullname',
            ],
        ];
    }

    public function datenschutzerklaerungs(): HasOne
    {
        return $this->hasOne(Datenschutzerklaerung::class, 'kunden_id');
    }

    public function fahrzeug(): HasMany
    {
        return $this->hasMany(Fahrzeuges::class)->orderBy('fz_model');
    }

    public function getFullnameAttribute(): string
    {
        return $this->kd_vorname.' '.$this->kd_name;
    }

    public function fullname(): string
    {
        return $this->kd_vorname.' '.$this->kd_name;
    }

    public function kundentype(): string
    {
        if ($this->kd_kundentype === 1) {
            $kundentype = 'Privatkunde';
        } else {
            $kundentype = 'Firma';
        }

        return $kundentype;
    }

    public function getKundeSeitAttribute(): string
    {
        $kundeSeit = '';
        if (! is_null($this->kd_kunde_seit)) {
            $kundeSeit = $this->kd_kunde_seit->format('d.m.Y');
        }

        return $kundeSeit;
    }

    public function getBirthdayAttribute(): string
    {
        $birthday = '';
        if (! is_null($this->kd_geburtsdatum)) {
            $birthday = $this->kd_geburtsdatum->format('d.m.Y').' ('.Carbon::parse($this->kd_geburtsdatum)->age.' Jahre)';
        }

        return $birthday;
    }

    public function totalKundens(): string
    {
        return 'Index insgesamt: '.self::count();
    }
}
