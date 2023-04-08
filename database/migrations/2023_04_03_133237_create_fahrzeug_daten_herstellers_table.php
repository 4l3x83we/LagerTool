<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_133237_create_fahrzeug_daten_herstellers_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:32
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fahrzeug_daten_herstellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('hersteller_id')->nullable();
            $table->string('fdh_hsn')->nullable();
            $table->string('fdh_tsn')->nullable();
            $table->string('fdh_type')->nullable();
            $table->integer('fdh_kw')->nullable();
            $table->integer('fdh_ps')->nullable();
            $table->integer('fdh_hubraum')->nullable();
            $table->string('fdh_kraftstoff')->nullable();
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
            $table->foreign('hersteller_id')->references('id')->on('herstellers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fahrzeug_daten_herstellers');
    }
};
