<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_05_03_072452_create_uploads_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 07:24
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artikel_id')->nullable();
            $table->unsignedBigInteger('fahrzeug_id')->nullable();
            $table->unsignedBigInteger('kunden_id')->nullable();
            $table->string('size')->nullable();
            $table->string('file')->nullable();
            $table->string('folder')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();

            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
            $table->foreign('fahrzeug_id')->references('id')->on('fahrzeuges')->onDelete('cascade');
            $table->foreign('kunden_id')->references('id')->on('kundens')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
