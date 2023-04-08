<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_131355_create_hersteller_artikels_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:13
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hersteller_artikels', function (Blueprint $table) {
            $table->id();
            $table->string('ha_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hersteller_artikels');
    }
};
