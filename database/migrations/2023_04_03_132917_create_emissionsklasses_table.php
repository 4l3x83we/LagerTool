<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_132917_create_emissionsklasses_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:29
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emissionsklasses', function (Blueprint $table) {
            $table->id();
            $table->string('emissionsklasse')->nullable();
            $table->unsignedBigInteger('kat_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emissionsklasses');
    }
};
