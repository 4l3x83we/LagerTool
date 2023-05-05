<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_29_072447_create_artikels_table.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 07:24
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('art_lieferant_id')->nullable();
            $table->string('art_nr')->index()->nullable();
            $table->string('art_name')->index()->nullable();
            $table->string('art_ean')->index()->nullable();
            $table->string('art_einheit')->nullable();
            $table->string('art_mwst')->nullable();
            $table->string('art_hersteller')->nullable();
            $table->longText('art_beschreibung')->nullable();
            $table->text('art_notiz')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
