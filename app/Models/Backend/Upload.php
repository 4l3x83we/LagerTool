<?php

namespace App\Models\Backend;

use App\Models\Backend\Artikel\Artikel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upload extends Model
{
    protected $fillable = ['artikel_id', 'fahrzeug_id', 'kunden_id', 'size', 'file', 'folder', 'path'];

    public function artikels(): BelongsTo
    {
        return $this->belongsTo(Artikel::class, 'id');
    }

    public function pathUpload()
    {
        return replaceStrToLower('images/'.$this->artikels->art_name.'/'.$this->artikels->id);
    }
}
