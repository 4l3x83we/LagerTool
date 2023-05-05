<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KundenSeeder.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 09:51
 */

namespace Database\Seeders;

use App\Models\Backend\Kunden\Datenschutzerklaerung;
use App\Models\Backend\Kunden\Kundens;
use Illuminate\Database\Seeder;

class KundenSeeder extends Seeder
{
    public function run(): void
    {
        $kunde = Kundens::create([
            'kd_kundennummer' => 1000,
            'kd_name' => 'Barkasse',
            'kd_kunde_seit' => now(),
        ]);

        Datenschutzerklaerung::create([
            'kunden_id' => $kunde->id,
            'da_erteilt_am' => now(),
            'da_briefe' => 1,
            'da_telefon' => 1,
            'da_fax' => 1,
            'da_mobile' => 1,
            'da_sms' => 1,
            'da_whatsapp' => 1,
            'da_email' => 1,
        ]);
    }
}
