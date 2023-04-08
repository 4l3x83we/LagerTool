<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_130549_create_stammdatens_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:05
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stammdatens', function (Blueprint $table) {
            $table->id();
            $table->string('sd_firmenname')->nullable();
            $table->string('sd_strasse')->nullable();
            $table->string('sd_plz')->nullable();
            $table->string('sd_ort')->nullable();
            $table->string('sd_telefon')->nullable();
            $table->string('sd_fax')->nullable();
            $table->string('sd_mobil')->nullable();
            $table->string('sd_steuernummer')->nullable();
            $table->string('sd_firmenzusatz')->nullable();
            $table->string('sd_absender')->nullable();
            $table->string('sd_laenderkuerzel')->nullable();
            $table->string('sd_webseite')->nullable();
            $table->string('sd_email')->nullable();
            $table->string('sd_ust_id')->nullable();
            $table->string('sd_kontoinhaber')->nullable();
            $table->string('sd_iban')->nullable();
            $table->string('sd_bic')->nullable();
            $table->string('sd_bankname')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stammdatens');
    }
};
