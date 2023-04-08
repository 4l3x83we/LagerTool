<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Stammdatens extends Model
{
    protected $fillable = ['sd_firmenname', 'sd_strasse', 'sd_plz', 'sd_ort', 'sd_telefon', 'sd_fax', 'sd_mobil', 'sd_steuernummer', 'sd_firmenzusatz', 'sd_absender', 'sd_laenderkuerzel', 'sd_webseite', 'sd_email', 'sd_ust_id', 'sd_kontoinhaber', 'sd_iban', 'sd_bic', 'sd_bankname'];

    public function pages(): array
    {
        return [
            [
                [
                    'text' => 'Company',
                    'link' => '',
                ],
            ],
        ];
    }
}
