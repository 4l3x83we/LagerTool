<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model as Model1;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Models extends Model1
{
    protected $fillable = ['hersteller_id', 'md_name'];

    public function hersteller(): BelongsTo
    {
        return $this->belongsTo(Hersteller::class)->orderBy('hr_name');
    }

    public function fahrzeugDatenHersteller(): HasMany
    {
        return $this->hasMany(FahrzeugDatenHersteller::class);
    }
}
