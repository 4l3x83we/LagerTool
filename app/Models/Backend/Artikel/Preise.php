<?php

namespace App\Models\Backend\Artikel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preise extends Model
{
    use SoftDeletes;

    protected $fillable = ['artikel_id', 'pr_ek_anzeigen', 'pr_netto_ek', 'pr_brutto_ek', 'pr_netto_vk', 'pr_brutto_vk', 'pr_mwst', 'pr_prg_1_netto_vk', 'pr_prg_2_netto_vk', 'pr_prg_3_netto_vk', 'pr_prg_4_netto_vk', 'pr_prg_5_netto_vk', 'pr_prg_1_brutto_vk', 'pr_prg_2_brutto_vk', 'pr_prg_3_brutto_vk', 'pr_prg_4_brutto_vk', 'pr_prg_5_brutto_vk'];

    public function artikels(): BelongsTo
    {
        return $this->belongsTo(Artikel::class);
    }

    public function bruttoVk(): string
    {
        return number_format($this->pr_brutto_vk, 2, ',', '.').' €';
    }

    public function nettoVk(): string
    {
        return number_format($this->pr_netto_vk, 2, ',', '.').' €';
    }

    public function nettoEk(): string
    {
        return number_format($this->pr_netto_ek, 2, ',', '.').' €';
    }
}
