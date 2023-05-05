<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_12_073517_create_fahrzeuges_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2023
 * Time: 07:35
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fahrzeuges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artikel_ld')->nullable();
            $table->unsignedBigInteger('lager_id')->nullable();
            $table->unsignedBigInteger('kunden_id')->nullable();
            $table->string('fz_kennzeichen', 10)->nullable();
            $table->string('fz_hersteller')->nullable();
            $table->string('fz_model')->nullable();
            $table->string('fz_type')->nullable();
            $table->date('fz_baujahr')->nullable();
            $table->string('fz_fz_id_nr', 17)->nullable();
            $table->string('fz_hubraum', 10)->nullable();
            $table->string('fz_kilometerstand', 10)->nullable();
            $table->string('fz_kw', 5)->nullable();
            $table->string('fz_ps', 5)->nullable();
            $table->string('fz_treibstoff')->nullable();
            $table->string('fz_motorcode')->nullable();
            $table->string('fz_getriebeart')->nullable();
            $table->string('fz_aufbau')->nullable();
            $table->integer('fz_sitzplaetze')->default(0)->nullable();
            $table->integer('fz_tueren')->default(0)->nullable();
            $table->integer('fz_schlafplaetze')->default(0)->nullable();
            $table->integer('fz_achsen')->default(0)->nullable();
            $table->integer('fz_gaenge')->default(0)->nullable();
            $table->integer('fz_zylinder')->default(0)->nullable();
            $table->integer('fz_leergewicht')->nullable();
            $table->integer('fz_nutzgewicht')->nullable();
            $table->integer('fz_gesamtgewicht')->nullable();
            $table->integer('fz_laenge')->nullable();
            $table->integer('fz_breite')->nullable();
            $table->integer('fz_hoehe')->nullable();
            $table->string('fz_hsn')->nullable();
            $table->string('fz_tsn')->nullable();
            $table->date('fz_hu')->nullable();
            $table->string('fz_kraftstoff')->nullable();
            $table->string('fz_plakette')->nullable();
            $table->string('fz_kat', 20)->nullable();
            $table->string('fz_emissionsklasse')->nullable();
            $table->string('fz_farbe')->nullable();
            $table->tinyInteger('fz_farbe_hersteller')->default(0)->nullable();
            $table->string('fz_hersteller_farbe')->nullable();
            $table->string('fz_farbcode')->nullable();
            $table->string('fz_polsterart')->nullable();
            $table->string('fz_polsterfarbe')->nullable();
            $table->string('fz_radiocode')->nullable();
            $table->string('fz_schluesselnummer')->nullable();
            $table->text('fz_infos')->nullable();
            $table->softDeletes();

            $table->foreign('kunden_id')->references('id')->on('kundens')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fahrzeuges');
    }
};
