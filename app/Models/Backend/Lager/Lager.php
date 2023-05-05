<?php

namespace App\Models\Backend\Lager;

use App\Models\Backend\Artikel\Artikel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lager extends Model
{
    use SoftDeletes;

    protected $fillable = ['artikel_id', 'la_bestand', 'la_lagerfuehrung', 'la_min', 'la_max', 'la_lagerort'];

    public function artikels(): BelongsTo
    {
        return $this->belongsTo(Artikel::class, 'id');
    }
}
