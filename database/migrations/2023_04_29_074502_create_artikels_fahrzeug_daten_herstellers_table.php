<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_29_074502_create_artikels_fahrzeug_daten_herstellers_table.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 07:45
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels_fahrzeug_daten_herstellers', function (Blueprint $table) {
            $table->unsignedBigInteger('artikel_id')->nullable();
            $table->unsignedBigInteger('fahrzeug_daten_hersteller_id')->nullable();
            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
            $table->foreign('fahrzeug_daten_hersteller_id')->references('id')->on('fahrzeug_daten_herstellers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels_fahrzeug_daten_herstellers');
    }
};
