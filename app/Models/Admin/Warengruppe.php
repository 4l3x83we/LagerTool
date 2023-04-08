<?php

namespace App\Models\Admin;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warengruppe extends Model
{
    use Sluggable;

    protected $fillable = ['wg_name', 'wg_slug', 'wg_parent_id'];

    public function sluggable(): array
    {
        return [
            'wg_slug' => [
                'source' => 'wg_name',
            ],
        ];
    }

    public function subWarengruppe(): HasMany
    {
        return $this->hasMany(__CLASS__, 'wg_parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'wg_parent_id');
    }
}
