<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Hersteller extends Model
{
    protected $fillable = [
        'hr_name',
    ];

    public function models()
    {
        return $this->hasMany(Models::class)->orderBy('md_name');
    }
}
