<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FahrzeugDatenHersteller extends Model
{
    protected $fillable = ['model_id', 'hersteller_id', 'fdh_hsn', 'fdh_tsn', 'fdh_type', 'fdh_kw', 'fdh_ps', 'fdh_hubraum', 'fdh_kraftstoff'];

    public function models(): BelongsTo
    {
        return $this->belongsTo(Models::class);
    }
}
