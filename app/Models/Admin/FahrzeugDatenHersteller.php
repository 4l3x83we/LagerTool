<?php

namespace App\Models\Admin;

use App\Models\Backend\Artikel\Artikel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FahrzeugDatenHersteller extends Model
{
    protected $fillable = ['model_id', 'hersteller_id', 'fdh_hsn', 'fdh_tsn', 'fdh_type', 'fdh_kw', 'fdh_ps', 'fdh_hubraum', 'fdh_kraftstoff'];

    public function models(): BelongsTo
    {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function hersteller(): BelongsTo
    {
        return $this->belongsTo(Hersteller::class, 'hersteller_id');
    }

    public function artikels(): BelongsToMany
    {
        return $this->belongsToMany(Artikel::class, 'artikels_fahrzeug_daten_herstellers');
    }

    public function pf()
    {
        $hersteller = $this->herstellerName();
        $model = $this->modelName();

        return $hersteller.' '.$model.', HSN: '.$this->fdh_hsn.', TSN: '.$this->fdh_tsn.', '.$this->fdh_hubraum.' ccm³, PS: '.$this->fdh_ps.', kW: '.$this->fdh_kw.', '.$this->fdh_kraftstoff;
    }

    public function herstellerName()
    {
        return Hersteller::where('id', '=', $this->hersteller_id)->first()->hr_name;
    }

    public function modelName()
    {
        return Models::where('id', '=', $this->model_id)->first()->md_name;
    }
}
