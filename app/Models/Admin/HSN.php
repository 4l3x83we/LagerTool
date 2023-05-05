<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HSN extends Model
{
    use SoftDeletes;

    protected $table = 'hsns';

    protected $fillable = ['hersteller_id', 'hsn'];

    public static function pages()
    {
        return [
            [
                [
                    'text' => 'HSN',
                    'link' => '',
                ],
            ],
        ];
    }

    public function hersteller(): belongsTo
    {
        return $this->belongsTo(Hersteller::class);
    }
}
