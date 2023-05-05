<?php

namespace App\Models\Admin;

use App\Models\Backend\Fahrzeuge\Fahrzeuges;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Models extends Model
{
    protected $fillable = ['hersteller_id', 'md_name'];

    public function hersteller(): BelongsTo
    {
        return $this->belongsTo(Hersteller::class)->orderBy('hr_name');
    }

    public function fahrzeug(): HasMany
    {
        return $this->hasMany(Fahrzeuges::class)->orderBy('fz_model');
    }

    public function fahrzeugDatenHersteller(): HasMany
    {
        return $this->hasMany(FahrzeugDatenHersteller::class);
    }

    public function fzType()
    {
        if (! $this->id) {
            $fzType = FahrzeugDatenHersteller::where('model_id', $this->id)->first()->fdh_type;
        } else {
            $fzType = '';
        }

        return $fzType;
    }
}
