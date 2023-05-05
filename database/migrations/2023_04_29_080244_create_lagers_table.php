<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_29_080244_create_lagers_table.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 08:02
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artikel_id')->nullable();
            $table->float('la_bestand', 8, 2)->nullable();
            $table->string('la_lagerfuehrung')->nullable();
            $table->float('la_min', 8, 2)->nullable();
            $table->float('la_max', 8, 2)->nullable();
            $table->string('la_lagerort')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lagers');
    }
};
