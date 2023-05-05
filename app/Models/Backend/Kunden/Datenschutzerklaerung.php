<?php

namespace App\Models\Backend\Kunden;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Datenschutzerklaerung extends Model
{
    use SoftDeletes;

    protected $fillable = ['kunden_id', 'da_erteilt_am', 'da_briefe', 'da_telefon', 'da_fax', 'da_mobile', 'da_sms', 'da_whatsapp', 'da_email'];

    protected $casts = ['da_erteilt_am' => 'date:Y-m-d'];

    public function kundens(): BelongsTo
    {
        return $this->belongsTo(Kundens::class);
    }

    public function erteiltAm(): string
    {
        $erteiltAm = '';
        if (! is_null($this->da_erteilt_am)) {
            $erteiltAm = $this->da_erteilt_am->format('d.m.Y');
        }

        return $erteiltAm;
    }
}
