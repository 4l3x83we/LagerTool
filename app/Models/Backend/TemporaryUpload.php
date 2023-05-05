<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class TemporaryUpload extends Model
{
    protected $fillable = ['folder', 'file'];

    protected $guarded = [];
}
