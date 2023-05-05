<?php

namespace App\Models\Admin;

use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hersteller extends Model
{
    protected $fillable = [
        'hr_name',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Models::class)->orderBy('md_name');
    }

    public function fahrzeug(): HasMany
    {
        return $this->hasMany(Fahrzeuges::class)->orderBy('fz_model');
    }

    public function fahrzeugDatenHersteller(): HasMany
    {
        return $this->hasMany(FahrzeugDatenHersteller::class);
    }

    public function hsns(): HasMany
    {
        return $this->hasMany(HSN::class);
    }
}
