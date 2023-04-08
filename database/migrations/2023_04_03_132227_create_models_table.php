<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_132227_create_models_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:22
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hersteller_id')->nullable();
            $table->string('md_name')->nullable();
            $table->foreign('hersteller_id')->references('id')->on('herstellers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
