<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = ['artikel_id', 'fahrzeug_id', 'kunden_id', 'size', 'file', 'folder', 'path'];
}
