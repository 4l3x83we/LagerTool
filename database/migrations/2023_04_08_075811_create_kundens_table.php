<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_08_075811_create_kundens_table.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 07:58
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kundens', function (Blueprint $table) {
            $table->id();

            $table->string('kd_kundennummer')->nullable();
            $table->tinyInteger('kd_kundentype')->default(true)->nullable();
            $table->string('kd_anrede')->nullable();
            $table->string('kd_name')->nullable();
            $table->string('kd_vorname')->nullable();
            $table->string('kd_zusatz')->nullable();
            $table->string('kd_strasse')->nullable();
            $table->string('kd_land')->nullable();
            $table->string('kd_plz')->nullable();
            $table->string('kd_ort')->nullable();
            $table->string('kd_telefon', 20)->nullable();
            $table->string('kd_telefon_gesch', 20)->nullable();
            $table->string('kd_fax', 20)->nullable();
            $table->string('kd_mobil', 20)->nullable();
            $table->string('kd_email')->nullable();
            $table->string('kd_webseite')->nullable();
            $table->string('kd_ust_id_nr')->nullable();
            $table->tinyInteger('kd_ausl_kunde')->default(false)->nullable();
            $table->tinyInteger('kd_anmerkungen_anzeigen')->default(false)->nullable();
            $table->integer('kd_rabatt_artikel')->nullable();
            $table->integer('kd_rabatt_arbeit')->nullable();
            $table->string('kd_zahlung')->nullable();
            $table->string('kd_preisgruppe')->nullable();
            $table->string('kd_debitor_nr')->nullable();
            $table->date('kd_geburtsdatum')->nullable();
            $table->date('kd_kunde_seit')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kundens');
    }
};
